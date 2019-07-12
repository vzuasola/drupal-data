<?php

namespace Drupal\zipang_promotions\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Zipang promotions entity entity.
 *
 * @ingroup zipang_promotions
 *
 * @ContentEntityType(
 *   id = "zipang_promotions_entity",
 *   label = @Translation("Zipang promotions entity"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\zipang_promotions\ZipangPromotionsEntityListBuilder",
 *     "views_data" = "Drupal\zipang_promotions\Entity\ZipangPromotionsEntityViewsData",
 *     "translation" = "Drupal\zipang_promotions\ZipangPromotionsEntityTranslationHandler",
 *
 *     "form" = {
 *       "default" = "Drupal\zipang_promotions\Form\ZipangPromotionsEntityForm",
 *       "add" = "Drupal\zipang_promotions\Form\ZipangPromotionsEntityForm",
 *       "edit" = "Drupal\zipang_promotions\Form\ZipangPromotionsEntityForm",
 *       "delete" = "Drupal\zipang_promotions\Form\ZipangPromotionsEntityDeleteForm",
 *     },
 *     "access" = "Drupal\zipang_promotions\ZipangPromotionsEntityAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\zipang_promotions\ZipangPromotionsEntityHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "zipang_promotions_entity",
 *   data_table = "zipang_promotions_entity_field_data",
 *   translatable = TRUE,
 *   admin_permission = "administer zipang promotions entity entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/config/zipang_promotions_entity/{zipang_promotions_entity}",
 *     "add-form" = "/admin/config/zipang_promotions_entity/add",
 *     "edit-form" = "/admin/config/zipang_promotions_entity/{zipang_promotions_entity}/edit",
 *     "delete-form" = "/admin/config/zipang_promotions_entity/{zipang_promotions_entity}/delete",
 *     "collection" = "/admin/config/zipang_promotions_entity",
 *   },
 *   field_ui_base_route = "zipang_promotions_entity.settings"
 * )
 */
class ZipangPromotionsEntity extends ContentEntityBase implements ZipangPromotionsEntityInterface {

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
      ->setDescription(t('The user ID of author of the Zipang promotions entity entity.'))
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
      ->setDescription(t('The name of the Zipang promotions entity entity.'))
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
      ->setDescription(t('A boolean indicating whether the Zipang promotions entity is published.'))
      ->setDefaultValue(TRUE);

    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

    return $fields;
  }

}
