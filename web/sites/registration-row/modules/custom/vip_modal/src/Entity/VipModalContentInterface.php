<?php

namespace Drupal\vip_modal\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Vip Modal Content Entity entities.
 *
 * @ingroup vip_modal
 */
interface VipModalContentInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Vip Modal Content Entity name.
   *
   * @return string
   *   Name of the Vip Modal Content Entity.
   */
  public function getName();

  /**
   * Sets the Vip Modal Content Entity name.
   *
   * @param string $name
   *   The Vip Modal Content Entity name.
   *
   * @return \Drupal\vip_modal\Entity\VipModalContentInterface
   *   The called Vip Modal Content Entity entity.
   */
  public function setName($name);

  /**
   * Gets the Vip Modal Content Entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Vip Modal Content Entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Vip Modal Content Entity creation timestamp.
   *
   * @param int $timestamp
   *   The Vip Modal Content Entity creation timestamp.
   *
   * @return \Drupal\vip_modal\Entity\VipModalContentInterface
   *   The called Vip Modal Content Entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Vip Modal Content Entity published status indicator.
   *
   * Unpublished Vip Modal Content Entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Vip Modal Content Entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Vip Modal Content Entity.
   *
   * @param bool $published
   *   TRUE to set this Vip Modal Content Entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\vip_modal\Entity\VipModalContentInterface
   *   The called Vip Modal Content Entity entity.
   */
  public function setPublished($published);

}
