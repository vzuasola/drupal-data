<?php

namespace Drupal\sportsbook_widget_api\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\sportsbook_widget_api\SportsbookWidgetApiInterface;
use Drupal\user\UserInterface;
use Drupal\Core\Entity\EntityChangedTrait;

/**
 * Defines the sportsbook widget api entity class.
 *
 * @ContentEntityType(
 *   id = "sportsbook_widget_api",
 *   label = @Translation("Sportsbook Widget API"),
 *   label_collection = @Translation("Sportsbook Widget APIs"), *   handlers = { *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder", *     "list_builder" = "Drupal\sportsbook_widget_api\SportsbookWidgetApiListBuilder",
 *     "views_data" = "Drupal\views\EntityViewsData", *     "access" = "Drupal\sportsbook_widget_api\SportsbookWidgetApiAccessControlHandler", *     "form" = {
 *       "add" = "Drupal\sportsbook_widget_api\Form\SportsbookWidgetApiForm",
 *       "edit" = "Drupal\sportsbook_widget_api\Form\SportsbookWidgetApiForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\Core\Entity\Routing\AdminHtmlRouteProvider",
 *     }
 *   },
 *   base_table = "sportsbook_widget_api",
 *   data_table = "sportsbook_widget_api_field_data", *   translatable = TRUE, *   admin_permission = "administer sportsbook widget api",
 *   entity_keys = {
 *     "id" = "id", *     "langcode" = "langcode", *     "label" = "title",
 *     "uuid" = "uuid"
 *   }, *   links = { *     "add-form" = "/admin/content/sportsbook-widget-api/add", *     "canonical" = "/sportsbook_widget_api/{sportsbook_widget_api}",
 *     "edit-form" = "/admin/content/sportsbook-widget-api/{sportsbook_widget_api}/edit",
 *     "delete-form" = "/admin/content/sportsbook-widget-api/{sportsbook_widget_api}/delete",
 *     "collection" = "/admin/content/sportsbook-widget-api"
 *   }, *   field_ui_base_route = "entity.sportsbook_widget_api.settings" * )
 */
class SportsbookWidgetApi extends ContentEntityBase implements SportsbookWidgetApiInterface
{
  use EntityChangedTrait;
  /**
   * {@inheritdoc}
   *
   * When a new sportsbook widget api entity is created, set the uid entity reference to
   * the current user as the creator of the entity.
   */
  public static function preCreate(EntityStorageInterface $storage_controller, array &$values)
  {
    parent::preCreate($storage_controller, $values);
    $values += ['uid' => \Drupal::currentUser()->id()];
  }
  /**
   * {@inheritdoc}
   */
  public function getTitle()
  {
    return $this->get('title')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setTitle($title)
  {
    $this->set('title', $title);
    return $this;
  }
  /**
   * {@inheritdoc}
   */
  public function isEnabled()
  {
    return (bool) $this->get('status')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setStatus($status)
  {
    $this->set('status', $status);
    return $this;
  }
  /**
   * {@inheritdoc}
   */
  public function getCreatedTime()
  {
    return $this->get('created')->value;
  }

  /**
   * {@inheritdoc}
   */
  public function setCreatedTime($timestamp)
  {
    $this->set('created', $timestamp);
    return $this;
  }
  /**
   * {@inheritdoc}
   */
  public function getOwner()
  {
    return $this->get('uid')->entity;
  }

  /**
   * {@inheritdoc}
   */
  public function getOwnerId()
  {
    return $this->get('uid')->target_id;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwnerId($uid)
  {
    $this->set('uid', $uid);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setOwner(UserInterface $account)
  {
    $this->set('uid', $account->id());
    return $this;
  }
  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type)
  {

    $fields = parent::baseFieldDefinitions($entity_type);
    $fields['title'] = BaseFieldDefinition::create('string')->setTranslatable(TRUE)->setLabel(t('Title'))
      ->setDescription(t('The title of the sportsbook widget api entity.'))
      ->setRequired(TRUE)
      ->setSetting('max_length', 255)
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('view', TRUE);
    $fields['status'] = BaseFieldDefinition::create('boolean')->setLabel(t('Status'))
      ->setDescription(t('A boolean indicating whether the sportsbook widget api is enabled.'))
      ->setDefaultValue(TRUE)
      ->setSetting('on_label', 'Enabled')
      ->setDisplayOptions('form', [
        'type' => 'boolean_checkbox',
        'settings' => [
          'display_label' => FALSE,
        ],
        'weight' => 0,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'type' => 'boolean',
        'label' => 'above',
        'weight' => 0,
        'settings' => [
          'format' => 'enabled-disabled',
        ],
      ])
      ->setDisplayConfigurable('view', TRUE);
    $fields['description'] = BaseFieldDefinition::create('text_long')->setTranslatable(TRUE)->setLabel(t('Description'))
      ->setDescription(t('A description of the sportsbook widget api.'))
      ->setDisplayOptions('form', [
        'type' => 'text_textarea',
        'weight' => 10,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'type' => 'text_default',
        'label' => 'above',
        'weight' => 10,
      ])
      ->setDisplayConfigurable('view', TRUE);
    $fields['uid'] = BaseFieldDefinition::create('entity_reference')->setTranslatable(TRUE)->setLabel(t('Author'))
      ->setDescription(t('The user ID of the sportsbook widget api author.'))
      ->setSetting('target_type', 'user')
      ->setDisplayOptions('form', [
        'type' => 'entity_reference_autocomplete',
        'settings' => [
          'match_operator' => 'CONTAINS',
          'size' => 60,
          'placeholder' => '',
        ],
        'weight' => 15,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'author',
        'weight' => 15,
      ])
      ->setDisplayConfigurable('view', TRUE);
    $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Authored on'))->setTranslatable(TRUE)->setDescription(t('The time that the sportsbook widget api was created.'))
      ->setDisplayOptions('view', [
        'label' => 'above',
        'type' => 'timestamp',
        'weight' => 20,
      ])
      ->setDisplayConfigurable('form', TRUE)
      ->setDisplayOptions('form', [
        'type' => 'datetime_timestamp',
        'weight' => 20,
      ])
      ->setDisplayConfigurable('view', TRUE);
    $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))->setTranslatable(TRUE)->setDescription(t('The time that the sportsbook widget api was last edited.'));
    return $fields;
  }
}
