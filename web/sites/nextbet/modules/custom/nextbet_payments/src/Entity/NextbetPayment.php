<?php

namespace Drupal\nextbet_payments\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Nextbet payment entity.
 *
 * @ingroup nextbet_payments
 *
 * @ContentEntityType(
 *   id = "nextbet_payment",
 *   label = @Translation("Nextbet payment"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\nextbet_payments\NextbetPaymentListBuilder",
 *     "views_data" = "Drupal\nextbet_payments\Entity\NextbetPaymentViewsData",
 *     "translation" = "Drupal\nextbet_payments\NextbetPaymentTranslationHandler",
 *
 *     "form" = {
 *       "default" = "Drupal\nextbet_payments\Form\NextbetPaymentForm",
 *       "add" = "Drupal\nextbet_payments\Form\NextbetPaymentForm",
 *       "edit" = "Drupal\nextbet_payments\Form\NextbetPaymentForm",
 *       "delete" = "Drupal\nextbet_payments\Form\NextbetPaymentDeleteForm",
 *     },
 *     "access" = "Drupal\nextbet_payments\NextbetPaymentAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\nextbet_payments\NextbetPaymentHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "nextbet_payment",
 *   data_table = "nextbet_payment_field_data",
 *   translatable = TRUE,
 *   admin_permission = "administer Nextbet payment entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/nextbet_payment/{nextbet_payment}",
 *     "add-form" = "/admin/structure/nextbet_payment/add",
 *     "edit-form" = "/admin/structure/nextbet_payment/{nextbet_payment}/edit",
 *     "delete-form" = "/admin/structure/nextbet_payment/{nextbet_payment}/delete",
 *     "collection" = "/admin/structure/nextbet_payment",
 *   },
 *   field_ui_base_route = "nextbet_payment.settings"
 * )
 */
class NextbetPayment extends ContentEntityBase implements NextbetPaymentInterface {

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
        $this->set('status', $published ? true : false);
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
        $fields = parent::baseFieldDefinitions($entity_type);

        $fields['user_id'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Authored by'))
      ->setDescription(t('The user ID of author of the Nextbet payment entity.'))
      ->setRevisionable(true)
      ->setSetting('target_type', 'user')
      ->setSetting('handler', 'default')
      ->setTranslatable(true)
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
      ->setDisplayConfigurable('form', true)
      ->setDisplayConfigurable('view', true);

        $fields['name'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Name'))
      ->setDescription(t('The name of the Nextbet payment entity.'))
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
      ->setDisplayConfigurable('form', true)
      ->setDisplayConfigurable('view', true);

        $fields['status'] = BaseFieldDefinition::create('boolean')
      ->setLabel(t('Publishing status'))
      ->setDescription(t('A boolean indicating whether the Nextbet payment is published.'))
      ->setDefaultValue(true);

        $fields['created'] = BaseFieldDefinition::create('created')
      ->setLabel(t('Created'))
      ->setDescription(t('The time that the entity was created.'));

        $fields['changed'] = BaseFieldDefinition::create('changed')
      ->setLabel(t('Changed'))
      ->setDescription(t('The time that the entity was last edited.'));

        return $fields;
    }
}
