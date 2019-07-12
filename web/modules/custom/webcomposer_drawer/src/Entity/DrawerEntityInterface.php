<?php

namespace Drupal\webcomposer_drawer\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Drawer entity entities.
 *
 * @ingroup webcomposer_drawer
 */
interface DrawerEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Drawer entity name.
   *
   * @return string
   *   Name of the Drawer entity.
   */
  public function getName();

  /**
   * Sets the Drawer entity name.
   *
   * @param string $name
   *   The Drawer entity name.
   *
   * @return \Drupal\webcomposer_drawer\Entity\DrawerEntityInterface
   *   The called Drawer entity entity.
   */
  public function setName($name);

  /**
   * Gets the Drawer entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Drawer entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Drawer entity creation timestamp.
   *
   * @param int $timestamp
   *   The Drawer entity creation timestamp.
   *
   * @return \Drupal\webcomposer_drawer\Entity\DrawerEntityInterface
   *   The called Drawer entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Drawer entity published status indicator.
   *
   * Unpublished Drawer entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Drawer entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Drawer entity.
   *
   * @param bool $published
   *   TRUE to set this Drawer entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\webcomposer_drawer\Entity\DrawerEntityInterface
   *   The called Drawer entity entity.
   */
  public function setPublished($published);

}
