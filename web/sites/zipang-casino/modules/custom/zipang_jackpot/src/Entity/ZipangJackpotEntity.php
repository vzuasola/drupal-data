<?php

namespace Drupal\zipang_jackpot\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Zipang jackpot entity entity.
 *
 * @ingroup zipang_jackpot
 *
 * @ContentEntityType(
 *   id = "zipang_jackpot_entity",
 *   label = @Translation("Zipang jackpot entity"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\zipang_jackpot\ZipangJackpotEntityListBuilder",
 *     "views_data" = "Drupal\zipang_jackpot\Entity\ZipangJackpotEntityViewsData",
 *     "translation" = "Drupal\zipang_jackpot\ZipangJackpotEntityTranslationHandler",
 *
 *     "form" = {
 *       "default" = "Drupal\zipang_jackpot\Form\ZipangJackpotEntityForm",
 *       "add" = "Drupal\zipang_jackpot\Form\ZipangJackpotEntityForm",
 *       "edit" = "Drupal\zipang_jackpot\Form\ZipangJackpotEntityForm",
 *       "delete" = "Drupal\zipang_jackpot\Form\ZipangJackpotEntityDeleteForm",
 *     },
 *     "access" = "Drupal\zipang_jackpot\ZipangJackpotEntityAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\zipang_jackpot\ZipangJackpotEntityHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "zipang_jackpot_entity",
 *   data_table = "zipang_jackpot_entity_field_data",
 *   translatable = TRUE,
 *   admin_permission = "administer zipang jackpot entity entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/config/zipang_jackpot/zipang_jackpot_entity/{zipang_jackpot_entity}",
 *     "add-form" = "/admin/config/zipang_jackpot/zipang_jackpot_entity/add",
 *     "edit-form" = "/admin/config/zipang_jackpot/zipang_jackpot_entity/{zipang_jackpot_entity}/edit",
 *     "delete-form" = "/admin/config/zipang_jackpot/zipang_jackpot_entity/{zipang_jackpot_entity}/delete",
 *     "collection" = "/admin/config/zipang_jackpot/zipang_jackpot_entity",
 *   },
 *   field_ui_base_route = "zipang_jackpot_entity.settings"
 * )
 */
class ZipangJackpotEntity extends ContentEntityBase implements ZipangJackpotEntityInterface {

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
      ->setDescription(t('The user ID of author of the Zipang jackpot entity entity.'))
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
      ->setDescription(t('The name of the Zipang jackpot entity entity.'))
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
      ->setDescription(t('A boolean indicating whether the Zipang jackpot entity is published.'))
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
