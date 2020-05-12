<?php

namespace Drupal\lucky_baby_desktop_games\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Lucky baby desktop games entity entity.
 *
 * @ingroup lucky_baby_desktop_games
 *
 * @ContentEntityType(
 *   id = "lucky_baby_desktop_games_entity",
 *   label = @Translation("Lucky baby desktop games entity"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\lucky_baby_desktop_games\LuckyBabyDesktopGamesEntityListBuilder",
 *     "views_data" = "Drupal\lucky_baby_desktop_games\Entity\LuckyBabyDesktopGamesEntityViewsData",
 *     "translation" = "Drupal\lucky_baby_desktop_games\LuckyBabyDesktopGamesEntityTranslationHandler",
 *
 *     "form" = {
 *       "default" = "Drupal\lucky_baby_desktop_games\Form\LuckyBabyDesktopGamesEntityForm",
 *       "add" = "Drupal\lucky_baby_desktop_games\Form\LuckyBabyDesktopGamesEntityForm",
 *       "edit" = "Drupal\lucky_baby_desktop_games\Form\LuckyBabyDesktopGamesEntityForm",
 *       "delete" = "Drupal\lucky_baby_desktop_games\Form\LuckyBabyDesktopGamesEntityDeleteForm",
 *     },
 *     "access" = "Drupal\lucky_baby_desktop_games\LuckyBabyDesktopGamesEntityAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\lucky_baby_desktop_games\LuckyBabyDesktopGamesEntityHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "lucky_baby_desktop_games_entity",
 *   data_table = "lucky_baby_desktop_games_entity_field_data",
 *   translatable = TRUE,
 *   admin_permission = "administer lucky baby desktop games entity entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/config/lucky_baby_desktop_games_entity/{lucky_baby_desktop_games_entity}",
 *     "add-form" = "/admin/config/lucky_baby_desktop_games_entity/add",
 *     "edit-form" = "/admin/config/lucky_baby_desktop_games_entity/{lucky_baby_desktop_games_entity}/edit",
 *     "delete-form" = "/admin/config/lucky_baby_desktop_games_entity/{lucky_baby_desktop_games_entity}/delete",
 *     "collection" = "/admin/config/lucky_baby_desktop_games_entity",
 *   },
 *   field_ui_base_route = "lucky_baby_desktop_games_entity.settings"
 * )
 */
class LuckyBabyDesktopGamesEntity extends ContentEntityBase implements LuckyBabyDesktopGamesEntityInterface {

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
      ->setDescription(t('The user ID of author of the Lucky baby desktop games entity entity.'))
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
      ->setDescription(t('The name of the Lucky baby desktop games entity entity.'))
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
      ->setDescription(t('A boolean indicating whether the Lucky baby desktop games entity is published.'))
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
