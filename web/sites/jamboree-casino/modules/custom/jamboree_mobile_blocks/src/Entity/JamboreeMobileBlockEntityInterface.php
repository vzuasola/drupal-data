<?php

namespace Drupal\jamboree_mobile_blocks\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Jamboree mobile block entity entities.
 *
 * @ingroup jamboree_mobile_blocks
 */
interface JamboreeMobileBlockEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Jamboree mobile block entity name.
   *
   * @return string
   *   Name of the Jamboree mobile block entity.
   */
  public function getName();

  /**
   * Sets the Jamboree mobile block entity name.
   *
   * @param string $name
   *   The Jamboree mobile block entity name.
   *
   * @return \Drupal\jamboree_mobile_blocks\Entity\JamboreeMobileBlockEntityInterface
   *   The called Jamboree mobile block entity entity.
   */
  public function setName($name);

  /**
   * Gets the Jamboree mobile block entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Jamboree mobile block entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Jamboree mobile block entity creation timestamp.
   *
   * @param int $timestamp
   *   The Jamboree mobile block entity creation timestamp.
   *
   * @return \Drupal\jamboree_mobile_blocks\Entity\JamboreeMobileBlockEntityInterface
   *   The called Jamboree mobile block entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Jamboree mobile block entity published status indicator.
   *
   * Unpublished Jamboree mobile block entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Jamboree mobile block entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Jamboree mobile block entity.
   *
   * @param bool $published
   *   TRUE to set this Jamboree mobile block entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\jamboree_mobile_blocks\Entity\JamboreeMobileBlockEntityInterface
   *   The called Jamboree mobile block entity entity.
   */
  public function setPublished($published);

}
