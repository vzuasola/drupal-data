<?php

namespace Drupal\games_page_background\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\RevisionableContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Game Page Background entity.
 *
 * @ingroup games_page_background
 *
 * @ContentEntityType(
 *   id = "game_page_background",
 *   label = @Translation("Game Page Background"),
 *   handlers = {
 *     "storage" = "Drupal\games_page_background\GamePageBackgroundStorage",
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\games_page_background\GamePageBackgroundListBuilder",
 *     "views_data" = "Drupal\games_page_background\Entity\GamePageBackgroundViewsData",
 *     "translation" = "Drupal\games_page_background\GamePageBackgroundTranslationHandler",
 *
 *     "form" = {
 *       "default" = "Drupal\games_page_background\Form\GamePageBackgroundForm",
 *       "add" = "Drupal\games_page_background\Form\GamePageBackgroundForm",
 *       "edit" = "Drupal\games_page_background\Form\GamePageBackgroundForm",
 *       "delete" = "Drupal\games_page_background\Form\GamePageBackgroundDeleteForm",
 *     },
 *     "access" = "Drupal\games_page_background\GamePageBackgroundAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\games_page_background\GamePageBackgroundHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "game_page_background",
 *   data_table = "game_page_background_field_data",
 *   revision_table = "game_page_background_revision",
 *   revision_data_table = "game_page_background_field_revision",
 *   translatable = TRUE,
 *   admin_permission = "administer game page Background entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "revision" = "vid",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/game_page_background/{game_page_background}",
 *     "add-form" = "/admin/structure/game_page_background/add",
 *     "edit-form" = "/admin/structure/game_page_background/{game_page_background}/edit",
 *     "delete-form" = "/admin/structure/game_page_background/{game_page_background}/delete",
 *     "version-history" = "/admin/structure/game_page_background/{game_page_background}/revisions",
 *     "revision" = "/admin/structure/game_page_background/{game_page_background}/revisions/{game_page_background_revision}/view",
 *     "revision_revert" = "/admin/structure/game_page_background/{game_page_background}/revisions/{game_page_background_revision}/revert",
 *     "revision_delete" = "/admin/structure/game_page_background/{game_page_background}/revisions/{game_page_background_revision}/delete",
 *     "translation_revert" = "/admin/structure/game_page_background/{game_page_background}/
 *            revisions/{game_page_background_revision}/revert/{langcode}",
 *     "collection" = "/admin/structure/game_page_background",
 *   },
 *   field_ui_base_route = "game_page_background.settings"
 * )
 */
class GamePageBackground extends RevisionableContentEntityBase implements GamePageBackgroundInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += [
      'user_id' => \Drupal::currentUser()->id(),
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function preSave(EntityStorageInterface $storage) {
    parent::preSave($storage);

    foreach (array_keys($this->getTranslationLanguages()) as $langcode) {
      $translation = $this->getTranslation($langcode);

      // If no owner has been set explicitly, make the anonymous user the owner.
      if (!$translation->getOwner()) {
        $translation->setOwnerId(0);
      }
    }

    // If no revision author has been set explicitly, make the game_page_background owner the
    // revision author.
    if (!$this->getRevisionUser()) {
      $this->setRevisionUserId($this->getOwnerId());
    }
  }

  /**
   * {@inheritdoc}
   */
  public function getName() {
    return $this->get('name')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setName($name) {
    $this->set('name', $name);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getCreatedTime() {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp) {
    $this->set('created', $timestamp);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwner() {
    return $this->get('user_id')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId() {
    return $this->get('user_id')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid) {
    $this->set('user_id', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account) {
    $this->set('user_id', $account->id());
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isPublished() {
    return (bool) $this->getEntityKey('status');
  }

  /**
   * {@inheritdoc}
   */
  public function setPublished($published) {
    $this->set('status', $published ? TRUE : FALSE);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Game Page Background entity.'))
      ->setRevisionable(TRUE)
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setTranslatable(TRUE)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'author',
        'weight' => 0,
      ])
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'weight' => 5,
        'settings' => [
          'match_operator' => 'CONTAINS',
          'size' => '60',
          'autocomplete_type' => 'tags',
          'placeholder' => '',
        ],
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the Game Page Background entity.'))
      ->setRevisionable(TRUE)
      ->setSettings([
        'max_length' => 50,
        'text_processing' => 0,
      ])
      ->setDefaultValue('')
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -4,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Publishing status'))
      ->setDescription(t('A boolean indicating whether the Game Page Background is published.'))
      ->setRevisionable(TRUE)
      ->setDefaultValue(TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    $fields['revision_translation_affected'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Revision translation affected'))
      ->setDescription(t('Indicates if the last edit of a translation belongs to current revision.'))
      ->setReadOnly(TRUE)
      ->setRevisionable(TRUE)
      ->setTranslatable(TRUE);

    return $fields;
  }

}
