<?php

namespace Drupal\jamboree_press\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Jamboree press entity entities.
 *
 * @ingroup jamboree_press
 */
interface JamboreePressEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Jamboree press entity name.
   *
   * @return string
   *   Name of the Jamboree press entity.
   */
  public function getName();

  /**
   * Sets the Jamboree press entity name.
   *
   * @param string $name
   *   The Jamboree press entity name.
   *
   * @return \Drupal\jamboree_press\Entity\JamboreePressEntityInterface
   *   The called Jamboree press entity entity.
   */
  public function setName($name);

  /**
   * Gets the Jamboree press entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Jamboree press entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Jamboree press entity creation timestamp.
   *
   * @param int $timestamp
   *   The Jamboree press entity creation timestamp.
   *
   * @return \Drupal\jamboree_press\Entity\JamboreePressEntityInterface
   *   The called Jamboree press entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Jamboree press entity published status indicator.
   *
   * Unpublished Jamboree press entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Jamboree press entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Jamboree press entity.
   *
   * @param bool $published
   *   TRUE to set this Jamboree press entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\jamboree_press\Entity\JamboreePressEntityInterface
   *   The called Jamboree press entity entity.
   */
  public function setPublished($published);

}
