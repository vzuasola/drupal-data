<?php

namespace Drupal\footer_casino_providers\Entity;

use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\user\UserInterface;

/**
 * Defines the Footer Casino Provider entity.
 *
 * @ingroup footer_casino_providers
 *
 * @ContentEntityType(
 *   id = "footer_casino_providers",
 *   label = @Translation("Footer Casino Provider"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\footer_casino_providers\FooterCasinoProviderListBuilder",
 *     "views_data" = "Drupal\footer_casino_providers\Entity\FooterCasinoProviderViewsData",
 *     "translation" = "Drupal\footer_casino_providers\FooterCasinoProviderTranslationHandler",
 *
 *     "form" = {
 *       "default" = "Drupal\footer_casino_providers\Form\FooterCasinoProviderForm",
 *       "add" = "Drupal\footer_casino_providers\Form\FooterCasinoProviderForm",
 *       "edit" = "Drupal\footer_casino_providers\Form\FooterCasinoProviderForm",
 *       "delete" = "Drupal\footer_casino_providers\Form\FooterCasinoProviderDeleteForm",
 *     },
 *     "access" = "Drupal\footer_casino_providers\FooterCasinoProviderAccessControlHandler",
 *     "route_provider" = {
 *       "html" = "Drupal\footer_casino_providers\FooterCasinoProviderHtmlRouteProvider",
 *     },
 *   },
 *   base_table = "footer_casino_providers",
 *   data_table = "footer_casino_providers_field_data",
 *   translatable = TRUE,
 *   admin_permission = "administer Footer Casino Provider entities",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "name",
 *     "uuid" = "uuid",
 *     "uid" = "user_id",
 *     "langcode" = "langcode",
 *     "status" = "status",
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/footer_casino_providers/{footer_casino_providers}",
 *     "add-form" = "/admin/structure/footer_casino_providers/add",
 *     "edit-form" = "/admin/structure/footer_casino_providers/{footer_casino_providers}/edit",
 *     "delete-form" = "/admin/structure/footer_casino_providers/{footer_casino_providers}/delete",
 *     "collection" = "/admin/structure/footer_casino_providers",
 *   },
 *   field_ui_base_route = "footer_casino_providers.settings"
 * )
 */
class FooterCasinoProvider extends ContentEntityBase implements FooterCasinoProvidersInterface {

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
      ->setDescription(t('The user ID of author of the Footer Casino Provider entity.'))
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
      ->setDescription(t('The name of the Footer Casino Provider entity.'))
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
      ->setDescription(t('A boolean indicating whether the Footer Casino Provider is published.'))
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
