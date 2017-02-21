<?php

namespace Drupal\matterhorn_blocks\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBase;

/**
 * Defines the Matterhorn block entity entity.
 *
 * @ConfigEntityType(
 *   id = "matterhorn_block_entity",
 *   label = @Translation("Matterhorn block entity"),
 *   handlers = {
 *     "list_builder" = "Drupal\matterhorn_blocks\MatterhornBlockEntityListBuilder",
 *     "form" = {
 *       "add" = "Drupal\matterhorn_blocks\Form\MatterhornBlockEntityForm",
 *       "edit" = "Drupal\matterhorn_blocks\Form\MatterhornBlockEntityForm",
 *       "delete" = "Drupal\matterhorn_blocks\Form\MatterhornBlockEntityDeleteForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\matterhorn_blocks\MatterhornBlockEntityHtmlRouteProvider",
 *     },
 *   },
 *   config_prefix = "matterhorn_block_entity",
 *   admin_permission = "administer site configuration",
 *   entity_keys = {
 *     "id" = "id",
 *     "label" = "label",
 *     "uuid" = "uuid"
 *   },
 *   links = {
 *     "canonical" = "/admin/structure/matterhorn_block_entity/{matterhorn_block_entity}",
 *     "add-form" = "/admin/structure/matterhorn_block_entity/add",
 *     "edit-form" = "/admin/structure/matterhorn_block_entity/{matterhorn_block_entity}/edit",
 *     "delete-form" = "/admin/structure/matterhorn_block_entity/{matterhorn_block_entity}/delete",
 *     "collection" = "/admin/structure/matterhorn_block_entity"
 *   }
 * )
 */
class MatterhornBlockEntity extends ConfigEntityBase implements MatterhornBlockEntityInterface {

  /**
   * The Matterhorn block entity ID.
   *
   * @var string
   */
  protected $id;

  /**
   * The Matterhorn block entity label.
   *
   * @var string
   */
  protected $label;

}
