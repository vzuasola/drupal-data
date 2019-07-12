<?php

namespace Drupal\jamboree_weekly_winner\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Jamboree weekly winner entity entity.
 *
 * @ingroup jamboree_weekly_winner
 *
 * @ContentEntityType(
 *   id = "jamboree_weekly_winner_entity",
 *   label = @Translation("Jamboree weekly winner entity"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\jamboree_weekly_winner\JamboreeWeeklyWinnerEntityListBuilder",
 *     "views_data" = "Drupal\jamboree_weekly_winner\Entity\JamboreeWeeklyWinnerEntityViewsData",
 *     "translation" = "Drupal\jamboree_weekly_winner\JamboreeWeeklyWinnerEntityTranslationHandler",
 *
 *     "form" = {
 *       "default" = "Drupal\jamboree_weekly_winner\Form\JamboreeWeeklyWinnerEntityForm",
 *       "add" = "Drupal\jamboree_weekly_winner\Form\JamboreeWeeklyWinnerEntityForm",
 *       "edit" = "Drupal\jamboree_weekly_winner\Form\JamboreeWeeklyWinnerEntityForm",
 *       "delete" = "Drupal\jamboree_weekly_winner\Form\JamboreeWeeklyWinnerEntityDeleteForm",
 *     },
 *     "access" = "Drupal\jamboree_weekly_winner\JamboreeWeeklyWinnerEntityAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\jamboree_weekly_winner\JamboreeWeeklyWinnerEntityHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "jamboree_weekly_winner_entity",
 *   data_table = "jamboree_weekly_winner_entity_field_data",
 *   translatable = TRUE,
 *   admin_permission = "administer jamboree weekly winner entity entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/jamboree_weekly_winner_entity/{jamboree_weekly_winner_entity}",
 *     "add-form" = "/admin/structure/jamboree_weekly_winner_entity/add",
 *     "edit-form" = "/admin/structure/jamboree_weekly_winner_entity/{jamboree_weekly_winner_entity}/edit",
 *     "delete-form" = "/admin/structure/jamboree_weekly_winner_entity/{jamboree_weekly_winner_entity}/delete",
 *     "collection" = "/admin/structure/jamboree_weekly_winner_entity",
 *   },
 *   field_ui_base_route = "jamboree_weekly_winner_entity.settings"
 * )
 */
class JamboreeWeeklyWinnerEntity extends ContentEntityBase implements JamboreeWeeklyWinnerEntityInterface {

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
      ->setDescription(t('The user ID of author of the Jamboree weekly winner entity entity.'))
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
      ->setDescription(t('The name of the Jamboree weekly winner entity entity.'))
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
      ->setDescription(t('A boolean indicating whether the Jamboree weekly winner entity is published.'))
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
