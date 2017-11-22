<?php

namespace Drupal\conflict\Form;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CloseDialogCommand;
use Drupal\Core\Ajax\CloseModalDialogCommand;
use Drupal\Core\Ajax\OpenModalDialogCommand;
use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Field\EntityReferenceFieldItemListInterface;
use Drupal\Core\Form\FormStateInterface;

class ConflictResolutionFormBuilder {

  public function processForm(&$form, FormStateInterface $form_state) {
    if ($form_state->get('conflict.build_conflict_resolution_form') || $form_state->get('conflict.processing')) {
      $conflict_paths = $form_state->get('conflict.paths');
      $path_titles = [];

      foreach ($conflict_paths as $path => $entity_metadata) {
        $path_titles[$path] = $this->getTitleForPropertyPath($path, $form_state);
      }

      $form['conflict_overview_form'] = [
        '#type' => 'container',
        '#title' => t('Conflict resolution'),
        '#id' => 'conflict-overview-form',
        '#attributes' => ['title' => t('Conflict resolution')],
      ];
      $form['conflict_overview_form']['description'] = [
        '#type' => 'container',
        '#markup' => t('The content has either been modified by another user, or you have already submitted modifications. In order to save your changes a manual conflict resolution should be performed by clicking on "Resolve conflicts".'),
        '#attributes' => ['class' => ['conflict-overview-form-description']]
      ];

      $header = [
        ['data' => t('Conflicts')]
      ];
      $rows = [];
      foreach ($path_titles as $path_title) {
        $rows[] = [
          'data' => [['data' => $path_title]],
        ];
      }
      $form['conflict_overview_form']['conflicts'] = [
        '#type' => 'table',
        '#header' => $header,
        '#rows' => $rows,
      ];
      $form['conflict_overview_form']['resolve_conflicts'] = [
        '#type' => 'submit',
        '#value' => t('Resolve conflicts'),
        '#name' => 'conflict-resolve-conflicts',
        '#limit_validation_errors' => [],
        '#validate' => [],
        '#submit' => [[get_class($this), 'resolveConflictsSubmit']],
        '#ajax' => [
          'callback' => [get_class($this), 'resolveConflictsAjax'],
        ],
      ];
      $form['conflict_overview_form']['reset_changes'] = [
        '#type' => 'button',
        '#value' => t('Start over'),
        '#name' => 'conflict-reset-changes',
      ];

      $form['conflict_overview_form']['#attached']['library'][] = 'conflict/drupal.conflict_resolution';
    }
  }

  public static function resolveConflictsSubmit($form, FormStateInterface $form_state) {
    // First entity to process.
    if ($form_state->get('conflict.build_conflict_resolution_form')) {
      // Reset the flag for building the overview form.
      $form_state->set('conflict.build_conflict_resolution_form', FALSE);
      $form_state->set('conflict.processing', TRUE);
      $form_state->set('conflict.first_processing', TRUE);
    }
    // Subsequent entities to process.
    else {
      $form_state->set('conflict.first_processing', FALSE);
    }
    $conflict_paths = $form_state->get('conflict.paths');
    if ($conflict_paths) {
      reset($conflict_paths);
      $path = key($conflict_paths);
      unset($conflict_paths[$path]);
      $form_state->set('conflict.paths', $conflict_paths);
      $form_state->set('conflict.processing_path', $path);
    }
    else {
      // @todo remove the dialog
      $form_state->set('conflict.processing', FALSE);
      $form_state->set('conflict.processing_path', NULL);
      // deaticate the resolve conflicts button or a final message for compeltion of resolving conflicts
    }

    $form_state->setCached();
  }

  public static function resolveConflictsAjax($form, FormStateInterface $form_state) {
    $response = new AjaxResponse();

    if ($form_state->get('conflict.first_processing')) {
      $response->addCommand(new CloseDialogCommand('#conflict-overview-form', TRUE));
    }

    $path = $form_state->get('conflict.processing_path');
    if (!is_null($path)) {
      $build = [];
      $title = t('Resolving conflicts in: ') . static::getTitleForPropertyPath($path, $form_state);

      $build['conflict_resolution_resolve_conflicts'] = [
        '#type' => 'submit',
        '#name' => 'conflict_resolution_resolve_conflicts',
        '#value' => empty($form_state->get('conflict.paths')) ? t('Finish conflict resolution') : t('Go to the next conflict'),
        '#weight' => 1000,
        '#attributes' => ['class' => ['conflict-resolve-conflicts']]
      ];

      $entity = static::getEntityForPropertyPath($path, $form_state);
      $conflict_ui_resolver = \Drupal::entityTypeManager()
        ->getHandler($entity->getEntityTypeId(), 'conflict_ui_resolver');
      $conflict_ui_resolver->addConflictResolution($path, $form_state, $entity, $build, $response);

      $options = [
        'dialogClass' => 'conflict-resolution-dialog conflict-resolution-dialog-step',
        'closeOnEscape' => FALSE,
        'resizable' => TRUE,
        'draggable' => TRUE,
        'width' => 'auto'
      ];
      $cmd = new OpenModalDialogCommand($title, $build, $options);
      $response->addCommand($cmd);
    }
    else {
      $close_modal_cmd = new CloseModalDialogCommand();
      $response->addCommand($close_modal_cmd);
    }

    return $response;
  }

  /**
   * Builds a title for the given property path.
   *
   * @param $path
   *   The property path.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return string
   *   The title for the given path.
   *
   * @throws \Exception
   *   An exception will be thrown in case the structure is not supported or it
   *   is not correct.
   */
  protected static function getTitleForPropertyPath($path, FormStateInterface $form_state) {
    $titles = [];
    $parents = $path ? explode('.', $path) : [];
    /** @var \Drupal\Core\Entity\EntityFormInterface $form_object */
    $form_object = $form_state->getFormObject();
    $element = $form_object->getEntity();
    $langcode = $element->language()->getId();
    $titles[] = '"' . $element->getEntityType()->getLabel() . ': ' . $element->label() . '"';

    while ($parents) {
      $next_element_identifier = array_shift($parents);
      if ($element instanceof ContentEntityInterface) {
        if (!$element->hasField($next_element_identifier)) {
          throw new \Exception('Not supported structure.');
        }
        $element = $element->get($next_element_identifier);
        $titles[] = $element->getFieldDefinition()->getLabel();
      }
      elseif ($element instanceof EntityReferenceFieldItemListInterface) {
        if (!isset($element[$next_element_identifier])) {
          throw new \Exception('Not supported structure.');
        }
        $field_label = array_pop($titles);
        if ($element->getFieldDefinition()->getFieldStorageDefinition()->isMultiple()) {
          $field_label = $field_label. ' '. t('at delta') . " $next_element_identifier";
        }

        /** @var \Drupal\Core\Field\FieldItemInterface $field_item */
        $field_item = $element->get($next_element_identifier);
        $properties = $field_item->getProperties(TRUE);
        if (!isset($properties['entity'])) {
          throw new \Exception('Not supported structure.');
        }

        /** @var \Drupal\Core\Entity\ContentEntityInterface $element */
        $element = $field_item->entity;
        if ($element->hasTranslation($langcode)) {
          $element = $element->getTranslation($langcode);
        }
        elseif (count($element->getTranslationLanguages()) > 1) {
          throw new \Exception('Not supported structure.');
        }
        $titles[] = $field_label . ' "' . $element->getEntityType()->getLabel() . ': ' . $element->label() . '"';
      }
      else {
        throw new \Exception('Not supported structure.');
      }
    }
    $title = implode(' => ', $titles);
    return $title;
  }

  /**
   * Returns the entity for the given property path.
   *
   * @param $path
   *   The property path.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   *
   * @return \Drupal\Core\Entity\EntityInterface
   *   The entity for the given path.
   *
   * @throws \Exception
   *   An exception will be thrown in case the structure is not supported or it
   *   is not correct.
   */
  protected static function getEntityForPropertyPath($path, FormStateInterface $form_state) {
    $parents = $path ? explode('.', $path) : [];
    /** @var \Drupal\Core\Entity\EntityFormInterface $form_object */
    $form_object = $form_state->getFormObject();
    $element = $form_object->getEntity();
    $langcode = $element->language()->getId();

    while ($parents) {
      $next_element_identifier = array_shift($parents);
      if ($element instanceof ContentEntityInterface) {
        if (!$element->hasField($next_element_identifier)) {
          throw new \Exception('Not supported structure.');
        }
        $element = $element->get($next_element_identifier);
      }
      elseif ($element instanceof EntityReferenceFieldItemListInterface) {
        if (!isset($element[$next_element_identifier])) {
          throw new \Exception('Not supported structure.');
        }
        /** @var \Drupal\Core\Field\FieldItemInterface $field_item */
        $field_item = $element->get($next_element_identifier);
        $properties = $field_item->getProperties(TRUE);
        if (!isset($properties['entity'])) {
          throw new \Exception('Not supported structure.');
        }

        /** @var \Drupal\Core\Entity\ContentEntityInterface $element */
        $element = $field_item->entity;
        if ($element->hasTranslation($langcode)) {
          $element = $element->getTranslation($langcode);
        }
        elseif (count($element->getTranslationLanguages()) > 1) {
          throw new \Exception('Not supported structure.');
        }
      }
      else {
        throw new \Exception('Not supported structure.');
      }
    }
    if (!$element instanceof EntityInterface) {
      throw new \Exception('Not supported structure.');
    }
    return $element;
  }

}