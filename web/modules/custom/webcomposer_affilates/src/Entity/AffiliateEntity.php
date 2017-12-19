<?php

namespace Drupal\webcomposer_affilates\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the Affiliate entity entity.
 *
 * @ConfigEntityType(
 *   id = "affiliate_entity",
 *   label = @Translation("Affiliate entity"),
 *   handlers = {
 *     "list_builder" = "Drupal\webcomposer_affilates\AffiliateEntityListBuilder",
 *     "form" = {
 *       "add" = "Drupal\webcomposer_affilates\Form\AffiliateEntityForm",
 *       "edit" = "Drupal\webcomposer_affilates\Form\AffiliateEntityForm",
 *       "delete" = "Drupal\webcomposer_affilates\Form\AffiliateEntityDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\webcomposer_affilates\AffiliateEntityHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "affiliate_entity",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/affiliate_entity/{affiliate_entity}",
 *     "add-form" = "/admin/structure/affiliate_entity/add",
 *     "edit-form" = "/admin/structure/affiliate_entity/{affiliate_entity}/edit",
 *     "delete-form" = "/admin/structure/affiliate_entity/{affiliate_entity}/delete",
 *     "collection" = "/admin/structure/affiliate_entity"
 *   }
 * )
 */
class AffiliateEntity extends ConfigEntityBase implements AffiliateEntityInterface {

  /**
   * The Affiliate entity ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Affiliate entity label.
   *
   * @var string
   */
  protected $label;

}
