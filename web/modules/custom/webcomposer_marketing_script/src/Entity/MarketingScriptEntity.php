<?php

namespace Drupal\webcomposer_marketing_script\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Marketing Script entity.
 *
 * @ingroup webcomposer_marketing_script
 *
 * @ContentEntityType(
 *   id = "marketing_script_entity",
 *   label = @Translation("Marketing Script"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\webcomposer_marketing_script\MarketingScriptEntityListBuilder",
 *     "views_data" = "Drupal\webcomposer_marketing_script\Entity\MarketingScriptEntityViewsData",
 *     "translation" = "Drupal\webcomposer_marketing_script\MarketingScriptEntityTranslationHandler",
 *
 *     "form" = {
 *       "default" = "Drupal\webcomposer_marketing_script\Form\MarketingScriptEntityForm",
 *       "add" = "Drupal\webcomposer_marketing_script\Form\MarketingScriptEntityForm",
 *       "edit" = "Drupal\webcomposer_marketing_script\Form\MarketingScriptEntityForm",
 *       "delete" = "Drupal\webcomposer_marketing_script\Form\MarketingScriptEntityDeleteForm",
 *     },
 *     "access" = "Drupal\webcomposer_marketing_script\MarketingScriptEntityAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\webcomposer_marketing_script\MarketingScriptEntityHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "marketing_script_entity",
 *   data_table = "marketing_script_entity_field_data",
 *   translatable = TRUE,
 *   admin_permission = "administer marketing script entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/config/webcomposer/marketing_script/marketing_script_entity/{marketing_script_entity}",
 *     "add-form" = "/admin/config/webcomposer/marketing_script/marketing_script_entity/add",
 *     "edit-form" = "/admin/config/webcomposer/marketing_script/marketing_script_entity/{marketing_script_entity}/edit",
 *     "delete-form" = "/admin/config/webcomposer/marketing_script/marketing_script_entity/{marketing_script_entity}/delete",
 *     "collection" = "/admin/config/webcomposer/marketing_script/marketing_script_entity",
 *   },
 *   field_ui_base_route = "marketing_script_entity.settings"
 * )
 */
class MarketingScriptEntity extends ContentEntityBase implements MarketingScriptEntityInterface {

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
      ->setDescription(t('The user ID of author of the Marketing Script entity.'))
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
      ->setRequired(TRUE)
      ->setDescription(t('The name of the Marketing Script entity.'))
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
      ->setDescription(t('A boolean indicating whether the Marketing Script is published.'))
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
