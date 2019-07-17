<?php

namespace Drupal\zipang_gallery\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityPublishedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Zipang gallery entity entity.
 *
 * @ingroup zipang_gallery
 *
 * @ContentEntityType(
 *   id = "zipang_gallery_entity",
 *   label = @Translation("Zipang gallery entity"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\zipang_gallery\ZipangGalleryEntityListBuilder",
 *     "views_data" = "Drupal\zipang_gallery\Entity\ZipangGalleryEntityViewsData",
 *     "translation" = "Drupal\zipang_gallery\ZipangGalleryEntityTranslationHandler",
 *
 *     "form" = {
 *       "default" = "Drupal\zipang_gallery\Form\ZipangGalleryEntityForm",
 *       "add" = "Drupal\zipang_gallery\Form\ZipangGalleryEntityForm",
 *       "edit" = "Drupal\zipang_gallery\Form\ZipangGalleryEntityForm",
 *       "delete" = "Drupal\zipang_gallery\Form\ZipangGalleryEntityDeleteForm",
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\zipang_gallery\ZipangGalleryEntityHtmlRouteProvider",
 *     },
 *     "access" = "Drupal\zipang_gallery\ZipangGalleryEntityAccessControlHandler",
 *   },
 *   base_table = "zipang_gallery_entity",
 *   data_table = "zipang_gallery_entity_field_data",
 *   translatable = TRUE,
 *   admin_permission = "administer zipang gallery entity entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "published" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/config/zipang_gallery_entity/{zipang_gallery_entity}",
 *     "add-form" = "/admin/config/zipang_gallery_entity/add",
 *     "edit-form" = "/admin/config/zipang_gallery_entity/{zipang_gallery_entity}/edit",
 *     "delete-form" = "/admin/config/zipang_gallery_entity/{zipang_gallery_entity}/delete",
 *     "collection" = "/admin/config/zipang_gallery_entity",
 *   },
 *   field_ui_base_route = "zipang_gallery_entity.settings"
 * )
 */
class ZipangGalleryEntity extends ContentEntityBase implements ZipangGalleryEntityInterface {

  use EntityChangedTrait;
  use EntityPublishedTrait;

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
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields = parent::baseFieldDefinitions($entity_type);

    // Add the published field.
    $fields += static::publishedBaseFieldDefinitions($entity_type);

    $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Zipang gallery entity entity.'))
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
      ->setDescription(t('The name of the Zipang gallery entity entity.'))
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
      ->setDisplayConfigurable('view', TRUE)
      ->setRequired(TRUE);

    $fields['status']->setDescription(t('A boolean indicating whether the Zipang gallery entity is published.'))
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'weight' => -3,
      ]);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
