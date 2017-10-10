<?php

namespace Drupal\registration_theme\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the Registration Theme entity.
 *
 * @ConfigEntityType(
 *   id = "registration_theme_entity",
 *   label = @Translation("Registration Theme"),
 *   handlers = {
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "list_builder" = "Drupal\registration_theme\RegistrationThemeEntityListBuilder",
 *     "form" = {
 *       "add" = "Drupal\registration_theme\Form\RegistrationThemeEntityForm",
 *       "edit" = "Drupal\registration_theme\Form\RegistrationThemeEntityForm",
 *       "delete" = "Drupal\registration_theme\Form\RegistrationThemeEntityDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\registration_theme\RegistrationThemeEntityHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "registration_theme_entity",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/config/registration/registration_theme_entity/{registration_theme_entity}",
 *     "add-form" = "/admin/config/registration/registration_theme_entity/add",
 *     "edit-form" = "/admin/config/registration/registration_theme_entity/{registration_theme_entity}/edit",
 *     "delete-form" = "/admin/config/registration/registration_theme_entity/{registration_theme_entity}/delete",
 *     "collection" = "/admin/config/registration/registration_theme_entity"
 *   }
 * )
 */
class RegistrationThemeEntity extends ConfigEntityBase implements RegistrationThemeEntityInterface {

  /**
   * The Registration Theme ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Registration Theme label.
   *
   * @var string
   */
  protected $label;

  protected $font_color;

  
  public function __construct(array $values, $entity_type) {
    parent::__construct($values, $entity_type);

    dpm($values);
  }


  public function getFontColor() {
    return $this->font_color;
  }

}
