<?php

namespace Drupal\conflict\Entity;

use Drupal\Component\Utility\NestedArray;
use Drupal\conflict\Field\FieldComparator\FieldComparatorManagerInterface;
use Drupal\Core\DependencyInjection\DependencySerializationTrait;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\Display\EntityFormDisplayInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityHandlerInterface;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ContentEntityConflictHandler implements EntityConflictHandlerInterface, EntityHandlerInterface {

  use DependencySerializationTrait;

  /**
   * The entity type.
   *
   * @var \Drupal\Core\Entity\EntityTypeInterface
   */
  protected $entityType;

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * The module handler to invoke the alter hook.
   *
   * @var \Drupal\Core\Extension\ModuleHandlerInterface
   */
  protected $moduleHandler;

  /**
   * The entity storage.
   *
   * @var \Drupal\Core\Entity\EntityStorageInterface
   */
  protected $storage;

  /**
   * The field comparator manager.
   *
   * @var \Drupal\conflict\Field\FieldComparator\FieldComparatorManagerInterface
   */
  protected $fieldComparatorManager;

  /**
   * EntityConflictResolutionHandlerDefault constructor.
   *
   * @param \Drupal\Core\Entity\EntityTypeInterface $entity_type
   *   The entity type.
   * @param \Drupal\conflict\Field\FieldComparator\FieldComparatorManagerInterface $field_comparator_manager
   *   The field comparator manager.
   */
  public function __construct(EntityTypeInterface $entity_type, EntityTypeManagerInterface $entity_type_manager, ModuleHandlerInterface $module_handler, FieldComparatorManagerInterface $field_comparator_manager) {
    $this->entityType = $entity_type;
    $this->entityTypeManager = $entity_type_manager;
    $this->storage = $entity_type_manager->getStorage($entity_type->id());
    $this->moduleHandler = $module_handler;
    $this->fieldComparatorManager = $field_comparator_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function createInstance(ContainerInterface $container, EntityTypeInterface $entity_type) {
    return new static(
      $entity_type,
      $container->get('entity_type.manager'),
      $container->get('module_handler'),
      $container->get('conflict.field_comparator.manager')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function entityFormAlter(array &$form, FormStateInterface $form_state, EntityInterface $entity, $inline_entity_form = FALSE) {
    // Let the conflict module updates the other translations before any other
    // entity builder has run, otherwise we might overwrite changes that will be
    // made by the entity builders on other translations. An example for this is
    // \Drupal\content_translation\ContentTranslationHandler::entityFormEntityBuild().
    $form['#entity_builders'] = isset($form['#entity_builders']) ? $form['#entity_builders'] : [];
    array_unshift($form['#entity_builders'], [$this, 'entityFormEntityBuilder']);

    // This check is actually not really needed, as #validate is only executed
    // at form level, not at inline form level, where only #element_validate
    // should be executed.
    if (!$inline_entity_form) {
      // @todo we have to ensure that our validate method is running at the end
      // but if there is another module which is moving its form_alter hook to
      // the end then there might be some collision. Should we decorate the
      // form builder instead and add our validate method after all the hooks
      // have run?
      $form['#validate'][] = [$this, 'entityMainFormValidateLast'];
    }
  }

  /**
   * Entity builder method.
   *
   * @param string $entity_type_id
   *   The entity type ID.
   * @param \Drupal\Core\Entity\EntityInterface $entity
   *   The entity.
   * @param $form
   *   The entity form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @see \Drupal\conflict\Entity\ContentEntityConflictHandler::entityFormAlter()
   */
  public function entityFormEntityBuilder($entity_type_id, EntityInterface $entity, &$form, FormStateInterface $form_state) {
    // Run only as part of the final form level submission.
    if (!$this->isFormLevelSubmission($form_state)) {
      return;
    }

    if (!$form_state->isValidationComplete() && ($entity instanceof ContentEntityInterface && !$entity->isNew())) {
      /** @var \Drupal\Core\Entity\ContentEntityInterface $entity_server */
      $id = $entity->id();
      $entity_server = $this->storage->loadUnchanged($id);
      /** @var \Drupal\Core\Entity\ContentEntityInterface $entity_original */
      $entity_original = $entity->{static::CONFLICT_ENTITY_ORIGINAL};
      $edited_langcode = $entity->language()->getId();

      // Currently we do not support concurrent editing in the following cases:
      //  - editing a translation that is removed on the newest version.
      //  - while creating a new translation.
      if (!$entity_server->hasTranslation($edited_langcode)) {
        if ($entity_original->hasTranslation($edited_langcode)) {
          // Currently being on a translation that has been removed in the
          // newest version.
          $form_state->setError($form, t('You are editing a translation, that has been removed meanwhile. As a result, your changes cannot be saved.'));
          return;
        }
        else {
          // @todo A new translation is being added. Currently we do not have
          // any support for concurrent editing during translating content. If
          // the entity has been modified meanwhile then the
          // EntityChangedConstraintValidator will fail.
          return;
        }
      }
      else {
        if (!$entity_original->hasTranslation($edited_langcode)) {
          $form_state->setError($form, t('You are creating a translation, that has been created meanwhile. As a result, your changes cannot be saved.'));
          return;
        }
      }

      // Work directly with the entity translations.
      $entity_server = $entity_server->getTranslation($edited_langcode);
      $entity_original = $entity_original->getTranslation($edited_langcode);

      // Check if the entity requires a merge.
      $needs_merge = $this->needsMerge($entity, $entity_original, $entity_server, FALSE);
      if ($needs_merge) {
        // Attach the server entity that will be used for the merge and leave it
        // attached for making it possible to track down what has been merged.
        $entity->{static::CONFLICT_ENTITY_SERVER} = $entity_server;

        // Auto merge changes in other translations and non-editable fields.
        $this->autoMergeNonEditedTranslations($entity, $entity_server);
        /** @var \Drupal\Core\Entity\ContentEntityFormInterface $form_object */
        $form_object = $form_state->getFormObject();
        $form_display = $form_object->getFormDisplay($form_state);
        $this->autoMergeNonEditableFields($entity, $entity_server, $form_display);

        // Check if a merge is still needed.
        $needs_merge = $this->needsMerge($entity, $entity_original, $entity_server, TRUE);
        if ($needs_merge) {
          // Merge the entity metadata, so that we prevent conflicts there.
          $this->autoMergeEntityMetadata($entity, $entity_server);

          if ($entity instanceof EntityChangedInterface) {
            $changed_path = $form['#parents'];
            $changed_path[] = 'changed';
            $input = &$form_state->getUserInput();
            NestedArray::setValue($input, $changed_path, $entity->getChangedTime());
          }

          // Manual merge is needed if even after the auto-merge of non-edited
          // translations and entity metadata there are still conflicts in the
          // current translation and non-translatable fields.
          $needs_merge = $this->hasConflicts($entity, $entity_original, $entity_server);
          $entity->{static::CONFLICT_ENTITY_NEEDS_MANUAL_MERGE} = $needs_merge;
        }

        // In case the entity still has conflicts then a user interaction is
        // needed.
        if ($needs_merge) {
          if ($entity->getEntityType()->get('conflict_ui_merge_supported')) {
            $path = implode('.', $form['#parents']);
            $conflict_paths = $form_state->get('conflict.paths') ?: [];
            $conflict_paths[$path] = ['entity_type' => $entity_type_id, 'entity_id' => $entity->id()];
            $form_state->set('conflict.paths', $conflict_paths);
          }
          else {
            $form_state->set('conflict_ui_merge_supported', FALSE);
            $message = t('The content has either been modified by another user, or you have already submitted modifications. As a result, your changes cannot be saved.');
            $message .= ' ' . t('Unfortunately no conflict resolution could be provided for the set of changes.');
            $form_state->setError($form, $message);
          }
        }
        else {
          // Exchange the original entity, as of now the original entity is the
          // one that has been merged into the edited entity and no further
          // actions are needed.
          $entity->{static::CONFLICT_ENTITY_ORIGINAL} = $entity_server;

          // Detach the server entity that is now original and entirely merged
          // into the current entity.
          $entity->{static::CONFLICT_ENTITY_SERVER} = NULL;

          // Flag the entity that it doesn't need a manual merge.
          $entity->{static::CONFLICT_ENTITY_NEEDS_MANUAL_MERGE} = FALSE;
        }
      }
      else {
        // Flag the entity that it doesn't need a manual merge.
        $entity->{static::CONFLICT_ENTITY_NEEDS_MANUAL_MERGE} = FALSE;
      }
    }
  }

  /**
   * Form level validation handler running after all others.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   */
  public function entityMainFormValidateLast(&$form, FormStateInterface $form_state) {
    // Run only as part of the final form level submission or if the form has
    // been completely validated and has no errors.
    if (!$this->isFormLevelSubmission($form_state) || $form_state::hasAnyErrors() || empty($form_state->get('conflict.paths'))) {
      return;
    }
    /** @var \Drupal\Core\Entity\ContentEntityFormInterface $form_object */
    $form_object = $form_state->getFormObject();
    // Support https://www.drupal.org/node/2833682.
    if (method_exists($form_object, 'getIntermediateEntity')) {
      $entity = $form_object->getIntermediateEntity();
    }
    else {
      $entity = $form_object->buildEntity($form, $form_state);
    }
    // Exchange the entity with the intermediate one and flag the form so that
    // the conflict resolution form gets appended on form rebuild.
    $form_object->setEntity($entity);
    $form_state->set('conflict.build_conflict_resolution_form', TRUE);
    $form_state->setCached(TRUE);
    $form_state->setRebuild(TRUE);

    $conflict_paths = &$form_state->get('conflict.paths');
    $this->moduleHandler->alter('conflict_paths', $conflict_paths, $form_state);
  }

  /**
   * Performs a check if a merge is required.
   *
   * @param \Drupal\Core\Entity\ContentEntityInterface $entity_local_edited
   *   The locally edited entity.
   * @param \Drupal\Core\Entity\ContentEntityInterface $entity_local_original
   *   The original not edited entity used to build the form.
   * @param \Drupal\Core\Entity\ContentEntityInterface $entity_server
   *   The unchanged entity loaded from the storage.
   * @param bool $extended_check
   *   (optional) Specifies whether an extended check should be performed in
   *   case the changed timestamp has been synchronized in
   *   ::autoMergeEntityMetadata().
   *
   * @return bool
   *   TRUE if a merge is needed, FALSE otherwise.
   */
  protected function needsMerge(ContentEntityInterface $entity_local_edited, ContentEntityInterface $entity_local_original, ContentEntityInterface $entity_server, $extended_check = FALSE) {
    if ($entity_local_edited->getEntityType()->isRevisionable()) {
      if ($entity_local_edited->getRevisionId() != $entity_server->getRevisionId()) {
        return TRUE;
      }
    }
    if (!$extended_check && ($entity_local_edited instanceof EntityChangedInterface)) {
      $entity_server_langcodes = array_keys($entity_server->getTranslationLanguages());
      $entity_local_edited_langcodes = array_keys($entity_local_edited->getTranslationLanguages());
      if ($entity_server_langcodes != $entity_local_edited_langcodes) {
        return TRUE;
      }
      foreach ($entity_server_langcodes as $langcode) {
        /** @var \Drupal\Core\Entity\EntityChangedInterface $entity_server_translation */
        $entity_server_translation = $entity_server->getTranslation($langcode);
        /** @var \Drupal\Core\Entity\EntityChangedInterface $entity_local_edited_translation */
        $entity_local_edited_translation = $entity_local_edited->getTranslation($langcode);
        if ($entity_server_translation->getChangedTime() != $entity_local_edited_translation->getChangedTime()) {
          return TRUE;
        }
      }
    }
    else {
      return $this->hasConflicts($entity_local_edited, $entity_local_original, $entity_server);
    }

    return FALSE;
  }

  /**
   * Merges translatable fields of non-edited translations.
   *
   * Additionally deleted translations will be removed and new translations will
   * be added.
   *
   * @param \Drupal\Core\Entity\ContentEntityInterface $entity_local_edited
   *   The locally edited entity.
   * @param \Drupal\Core\Entity\ContentEntityInterface $entity_server
   *   The unchanged entity loaded from the storage.
   */
  protected function autoMergeNonEditedTranslations(ContentEntityInterface $entity_local_edited, ContentEntityInterface $entity_server) {
    $edited_langcode = $entity_local_edited->language()->getId();
    $entity_server_langcodes = array_keys($entity_server->getTranslationLanguages());
    $entity_local_edited_langcodes = array_keys($entity_local_edited->getTranslationLanguages());

    foreach ($entity_server_langcodes as $langcode) {
      if ($langcode == $edited_langcode) {
        continue;
      }
      // @todo we should set that the translation is not new.
      $entity_server_translation = $entity_server->getTranslation($langcode);
      $entity_local_edited_translation = $entity_local_edited->hasTranslation($langcode) ? $entity_local_edited->getTranslation($langcode) : $entity_local_edited->addTranslation($langcode);

      // @todo If the entity implements the EntityChangedInterface then first
      // check the changed timestamps as a shortcut to skip updating fields of
      // translations that haven't changed, but for that we have to ensure
      if ($entity_server_translation->getChangedTime() != $entity_local_edited_translation->getChangedTime()) {
        foreach ($entity_server_translation->getTranslatableFields() as $field_name => $field_item_list) {
          $entity_local_edited_translation->set($field_name, $field_item_list->getValue());
        }
      }
    }

    foreach (array_diff($entity_local_edited_langcodes, $entity_server_langcodes) as $langcode) {
      $entity_local_edited->removeTranslation($langcode);
    }
  }

  /**
   * Merges non-editable fields.
   *
   * As non-editable fields are considered fields that are not contained in the
   * form display or the current user does not have edit access for them.
   *
   * @param \Drupal\Core\Entity\ContentEntityInterface $entity_local_edited
   *   The locally edited entity.
   * @param \Drupal\Core\Entity\ContentEntityInterface $entity_server
   *   The unchanged entity loaded from the storage.
   * @param \Drupal\Core\Entity\Display\EntityFormDisplayInterface $form_display
   *   The form display that the entity form operates with.
   */
  protected function autoMergeNonEditableFields(ContentEntityInterface $entity_local_edited, ContentEntityInterface $entity_server, EntityFormDisplayInterface $form_display) {
    $components = $form_display->getComponents();
    foreach ($entity_local_edited->getFields() as $field_name => $items) {
      if (!isset($components[$field_name]) || !$items->access('edit')) {
        $items->setValue($entity_server->get($field_name)->getValue(TRUE));
      }
    }
  }

  /**
   * Merges entity metadata.
   *
   * For entities implementing the EntityChangedInterface, the changed time will
   * be merged.
   * For revisionable entities the revision ID will be merged.
   *
   * @param \Drupal\Core\Entity\ContentEntityInterface $entity_local_edited
   *   The locally edited entity.
   * @param \Drupal\Core\Entity\ContentEntityInterface $entity_server
   *   The unchanged entity loaded from the storage.
   */
  protected function autoMergeEntityMetadata(ContentEntityInterface $entity_local_edited, ContentEntityInterface $entity_server) {
    if ($entity_local_edited instanceof EntityChangedInterface) {
      $entity_local_edited->setChangedTime($entity_server->getChangedTime());
    }
    $entity_type = $entity_local_edited->getEntityType();
    if ($entity_type->isRevisionable()) {
      $entity_local_edited->set($entity_type->getKey('revision'), $entity_server->getRevisionId());
      $entity_local_edited->updateLoadedRevisionId();
    }
  }

  /**
   * Checks whether there are conflicts.
   *
   * @param \Drupal\Core\Entity\ContentEntityInterface $entity_local_edited
   *   The locally edited entity.
   * @param \Drupal\Core\Entity\ContentEntityInterface $entity_local_original
   *   The original not edited entity used to build the form.
   * @param \Drupal\Core\Entity\ContentEntityInterface $entity_server
   *   The unchanged entity loaded from the storage.
   *
   * @return bool
   *
   */
  protected function hasConflicts(ContentEntityInterface $entity_local_edited, ContentEntityInterface $entity_local_original, ContentEntityInterface $entity_server) {
    $entity_type_id = $entity_local_edited->getEntityTypeId();
    $entity_bundle = $entity_local_edited->bundle();
    $langcode = $entity_local_edited->language()->getId();
    $entity_server = $entity_server->getTranslation($langcode);
    $entity_local_original = $entity_local_original->getTranslation($langcode);

    foreach ($entity_local_edited->getFields() as $field_name => $field_items_list_local_edited) {
      $field_definition = $field_items_list_local_edited->getFieldDefinition();
      // There could be no conflicts in read only fields.
      if ($field_definition->isReadOnly()) {
        continue;
      }
      $field_type = $field_definition->getType();
      $field_items_list_server = $entity_server->get($field_name);
      $field_items_list_local_original = $entity_local_original->get($field_name);

      // Check for changes between the server the locally edited version. If
      // there are no changes between them then it might happen that a field
      // is changed in both versions to the same value, which we do not
      // consider as any conflict.
      if ($this->fieldComparatorManager->hasChanged($field_items_list_server, $field_items_list_local_edited, $langcode, $entity_type_id, $entity_bundle, $field_type, $field_name)) {
        // Check for changes between the server the locally used original
        // version. If the server version has changed compared to the locally
        // used original version then there is a conflict either
        //   - value changed only on the server
        //   - value changed both on the server and locally
        if ($this->fieldComparatorManager->hasChanged($field_items_list_server, $field_items_list_local_original, $langcode, $entity_type_id, $entity_bundle, $field_type, $field_name)) {
          return TRUE;
        }
      }
    }
    return FALSE;
  }

  /**
   * Returns the entity conflicts.
   *
   * @param \Drupal\Core\Entity\ContentEntityInterface $entity_local_original
   *   The locally edited entity.
   * @param \Drupal\Core\Entity\ContentEntityInterface $entity_local_edited
   *   The original not edited entity used to build the form.
   * @param \Drupal\Core\Entity\ContentEntityInterface $entity_server
   *   The unchanged entity loaded from the storage.
   *
   * @return array
   *   An array of conflicts, keyed by the field name having as value the
   *   conflict type.
   */
  protected function getConflicts(ContentEntityInterface $entity_local_original, ContentEntityInterface $entity_local_edited, ContentEntityInterface $entity_server) {
    $conflicts = [];

    $entity_type_id = $entity_local_edited->getEntityTypeId();
    $entity_bundle = $entity_local_edited->bundle();

    $langcode = $entity_local_edited->language()->getId();
    $entity_server = $entity_server->getTranslation($langcode);
    $entity_local_original = $entity_local_original->getTranslation($langcode);
    foreach ($entity_local_edited->getFields() as $field_name => $field_items_list_local_edited) {
      $field_definition = $field_items_list_local_edited->getFieldDefinition();
      // There could be no conflicts in read only fields.
      if ($field_definition->isReadOnly()) {
        continue;
      }
      $field_type = $field_definition->getType();
      $field_items_list_server = $entity_server->get($field_name);
      $field_items_list_local_original = $entity_local_original->get($field_name);

      // Check for changes between the server the locally edited version.
      if ($this->fieldComparatorManager->hasChanged($field_items_list_server, $field_items_list_local_edited, $langcode, $entity_type_id, $entity_bundle, $field_type, $field_name)) {
        // Check for changes between the server the locally used original
        // version.
        if ($this->fieldComparatorManager->hasChanged($field_items_list_server, $field_items_list_local_original, $langcode, $entity_type_id, $entity_bundle, $field_type, $field_name)) {
          // Check for changes between the locally edited and locally used
          // original version.
          $conflict_type = $this->fieldComparatorManager->hasChanged($field_items_list_local_edited, $field_items_list_local_original, $langcode, $entity_type_id, $entity_bundle, $field_type, $field_name) ? static::CONFLICT_TYPE_BOTH : static::CONFLICT_TYPE_SERVER_ONLY;
          $conflicts[$field_name] = $conflict_type;
        }
      }
    }
    return $conflicts;
  }

  /**
   * Determines if the form level submission has been triggered.
   *
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return bool
   *   TRUE if the form has been submitted for final submission, FALSE otherwise.
   */
  protected function isFormLevelSubmission(FormStateInterface $form_state) {
    return in_array('::submitForm', $form_state->getSubmitHandlers());
  }

}
