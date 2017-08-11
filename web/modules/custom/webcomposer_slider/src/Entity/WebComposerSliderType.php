<?php

namespace Drupal\webcomposer_slider\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Web Composer Slider type entity.
 *
 * @ConfigEntityType(
 *   id = "web_composer_slider_type",
 *   label = @Translation("Web Composer Slider type"),
 *   handlers = {
 *     "list_builder" = "Drupal\webcomposer_slider\WebComposerSliderTypeListBuilder",
 *     "form" = {
 *       "add" = "Drupal\webcomposer_slider\Form\WebComposerSliderTypeForm",
 *       "edit" = "Drupal\webcomposer_slider\Form\WebComposerSliderTypeForm",
 *       "delete" = "Drupal\webcomposer_slider\Form\WebComposerSliderTypeDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\webcomposer_slider\WebComposerSliderTypeHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "web_composer_slider_type",
 *   admin_permission = "administer site configuration",
 *   bundle_of = "web_composer_slider",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/web_composer_slider_type/{web_composer_slider_type}",
 *     "add-form" = "/admin/structure/web_composer_slider_type/add",
 *     "edit-form" = "/admin/structure/web_composer_slider_type/{web_composer_slider_type}/edit",
 *     "delete-form" = "/admin/structure/web_composer_slider_type/{web_composer_slider_type}/delete",
 *     "collection" = "/admin/structure/web_composer_slider_type"
 *   }
 * )
 */
class WebComposerSliderType extends ConfigEntityBundleBase implements WebComposerSliderTypeInterface {

  /**
   * The Web Composer Slider type ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Web Composer Slider type label.
   *
   * @var string
   */
  protected $label;

}
