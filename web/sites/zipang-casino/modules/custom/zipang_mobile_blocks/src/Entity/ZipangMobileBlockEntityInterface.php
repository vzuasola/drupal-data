<?php

namespace Drupal\zipang_mobile_blocks\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Zipang mobile block entity entities.
 *
 * @ingroup zipang_mobile_blocks
 */
interface ZipangMobileBlockEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Zipang mobile block entity name.
   *
   * @return string
   *   Name of the Zipang mobile block entity.
   */
  public function getName();

  /**
   * Sets the Zipang mobile block entity name.
   *
   * @param string $name
   *   The Zipang mobile block entity name.
   *
   * @return \Drupal\zipang_mobile_blocks\Entity\ZipangMobileBlockEntityInterface
   *   The called Zipang mobile block entity entity.
   */
  public function setName($name);

  /**
   * Gets the Zipang mobile block entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Zipang mobile block entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Zipang mobile block entity creation timestamp.
   *
   * @param int $timestamp
   *   The Zipang mobile block entity creation timestamp.
   *
   * @return \Drupal\zipang_mobile_blocks\Entity\ZipangMobileBlockEntityInterface
   *   The called Zipang mobile block entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Zipang mobile block entity published status indicator.
   *
   * Unpublished Zipang mobile block entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Zipang mobile block entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Zipang mobile block entity.
   *
   * @param bool $published
   *   TRUE to set this Zipang mobile block entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\zipang_mobile_blocks\Entity\ZipangMobileBlockEntityInterface
   *   The called Zipang mobile block entity entity.
   */
  public function setPublished($published);

}
