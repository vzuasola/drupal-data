<?php

namespace Drupal\msw_legal_agreement\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Registration Legal Agreement entity.
 *
 * @ingroup msw_legal_agreement
 *
 * @ContentEntityType(
 *   id = "msw_legal_agreement",
 *   label = @Translation("Registration Legal Agreement"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\msw_legal_agreement\MswLegalAgreementListBuilder",
 *     "views_data" = "Drupal\msw_legal_agreement\Entity\MswLegalAgreementViewsData",
 *     "translation" = "Drupal\msw_legal_agreement\MswLegalAgreementTranslationHandler",
 *
 *     "form" = {
 *       "default" = "Drupal\msw_legal_agreement\Form\MswLegalAgreementForm",
 *       "add" = "Drupal\msw_legal_agreement\Form\MswLegalAgreementForm",
 *       "edit" = "Drupal\msw_legal_agreement\Form\MswLegalAgreementForm",
 *       "delete" = "Drupal\msw_legal_agreement\Form\MswLegalAgreementDeleteForm",
 *     },
 *     "access" = "Drupal\msw_legal_agreement\MswLegalAgreementAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\msw_legal_agreement\MswLegalAgreementHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "msw_legal_agreement",
 *   data_table = "msw_legal_agreement_field_data",
 *   translatable = TRUE,
 *   admin_permission = "administer msw legal agreement entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/msw_legal_agreement/{msw_legal_agreement}",
 *     "add-form" = "/admin/structure/msw_legal_agreement/add",
 *     "edit-form" = "/admin/structure/msw_legal_agreement/{msw_legal_agreement}/edit",
 *     "delete-form" = "/admin/structure/msw_legal_agreement/{msw_legal_agreement}/delete",
 *     "collection" = "/admin/structure/msw_legal_agreement",
 *   },
 *   field_ui_base_route = "msw_legal_agreement.settings"
 * )
 */
class MswLegalAgreement extends ContentEntityBase implements MswLegalAgreementInterface {

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
      ->setDescription(t('The user ID of author of the Registration Legal Agreement entity.'))
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
      ->setDescription(t('The name of the registration legal agreement entity.'))
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
      ->setDescription(t('A boolean indicating whether the registration legal agreement is published.'))
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
