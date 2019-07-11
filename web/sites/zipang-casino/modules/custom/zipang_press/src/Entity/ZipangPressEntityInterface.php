<?php

namespace Drupal\zipang_press\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Zipang press entity entities.
 *
 * @ingroup zipang_press
 */
interface ZipangPressEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Zipang press entity name.
   *
   * @return string
   *   Name of the Zipang press entity.
   */
  public function getName();

  /**
   * Sets the Zipang press entity name.
   *
   * @param string $name
   *   The Zipang press entity name.
   *
   * @return \Drupal\zipang_press\Entity\ZipangPressEntityInterface
   *   The called Zipang press entity entity.
   */
  public function setName($name);

  /**
   * Gets the Zipang press entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Zipang press entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Zipang press entity creation timestamp.
   *
   * @param int $timestamp
   *   The Zipang press entity creation timestamp.
   *
   * @return \Drupal\zipang_press\Entity\ZipangPressEntityInterface
   *   The called Zipang press entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Zipang press entity published status indicator.
   *
   * Unpublished Zipang press entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Zipang press entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Zipang press entity.
   *
   * @param bool $published
   *   TRUE to set this Zipang press entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\zipang_press\Entity\ZipangPressEntityInterface
   *   The called Zipang press entity entity.
   */
  public function setPublished($published);

}
