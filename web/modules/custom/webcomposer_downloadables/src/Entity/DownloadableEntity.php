<?php

namespace Drupal\webcomposer_downloadables\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Downloadable entity entity.
 *
 * @ingroup webcomposer_downloadables
 *
 * @ContentEntityType(
 *   id = "downloadable_entity",
 *   label = @Translation("Downloadable entity"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\webcomposer_downloadables\DownloadableEntityListBuilder",
 *     "views_data" = "Drupal\webcomposer_downloadables\Entity\DownloadableEntityViewsData",
 *     "translation" = "Drupal\webcomposer_downloadables\DownloadableEntityTranslationHandler",
 *
 *     "form" = {
 *       "default" = "Drupal\webcomposer_downloadables\Form\DownloadableEntityForm",
 *       "add" = "Drupal\webcomposer_downloadables\Form\DownloadableEntityForm",
 *       "edit" = "Drupal\webcomposer_downloadables\Form\DownloadableEntityForm",
 *       "delete" = "Drupal\webcomposer_downloadables\Form\DownloadableEntityDeleteForm",
 *     },
 *     "access" = "Drupal\webcomposer_downloadables\DownloadableEntityAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\webcomposer_downloadables\DownloadableEntityHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "downloadable_entity",
 *   data_table = "downloadable_entity_field_data",
 *   translatable = TRUE,
 *   admin_permission = "administer downloadable entity entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/config/webcomposer/downloadable/downloadable_entity/{downloadable_entity}",
 *     "add-form" = "/admin/config/webcomposer/downloadable/downloadable_entity/add",
 *     "edit-form" = "/admin/config/webcomposer/downloadable/downloadable_entity/{downloadable_entity}/edit",
 *     "delete-form" = "/admin/config/webcomposer/downloadable/downloadable_entity/{downloadable_entity}/delete",
 *     "collection" = "/admin/config/webcomposer/downloadable/downloadable_entity",
 *   },
 *   field_ui_base_route = "downloadable_entity.settings"
 * )
 */
class DownloadableEntity extends ContentEntityBase implements DownloadableEntityInterface {

  use EntityChangedTrait;

  /**
   * {@inheritdoc}
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values) {
    parent::preCreate($storage_controller, $values);
    $values += array(
      'user_id' => \Drupal::currentUser()->id(),
    );
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
      ->setDescription(t('The user ID of author of the Downloadable entity entity.'))
      ->setRevisionable(TRUE)
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setTranslatable(TRUE)
      ->setDisplayOptions('view', array(
        'label' => 'hidden',
        'type' => 'author',
        'weight' => 0,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'entity_reference_autocomplete',
        'weight' => 5,
        'settings' => array(
          'match_operator' => 'CONTAINS',
          'size' => '60',
          'autocomplete_type' => 'tags',
          'placeholder' => '',
        ),
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the Downloadable entity entity.'))
      ->setSettings(array(
        'max_length' => 50,
        'text_processing' => 0,
      ))
      ->setDefaultValue('')
      ->setDisplayOptions('view', array(
        'label' => 'above',
        'type' => 'string',
        'weight' => -4,
      ))
      ->setDisplayOptions('form', array(
        'type' => 'string_textfield',
        'weight' => -4,
      ))
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayConfigurable('view', TRUE);

    $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Publishing status'))
      ->setDescription(t('A boolean indicating whether the Downloadable entity is published.'))
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
