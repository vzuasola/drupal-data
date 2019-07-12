<?php

namespace Drupal\zipang_dropdown_menu\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Dropdown menu entity entities.
 *
 * @ingroup zipang_dropdown_menu
 */
interface DropdownMenuEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Dropdown menu entity name.
   *
   * @return string
   *   Name of the Dropdown menu entity.
   */
  public function getName();

  /**
   * Sets the Dropdown menu entity name.
   *
   * @param string $name
   *   The Dropdown menu entity name.
   *
   * @return \Drupal\zipang_dropdown_menu\Entity\DropdownMenuEntityInterface
   *   The called Dropdown menu entity entity.
   */
  public function setName($name);

  /**
   * Gets the Dropdown menu entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Dropdown menu entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Dropdown menu entity creation timestamp.
   *
   * @param int $timestamp
   *   The Dropdown menu entity creation timestamp.
   *
   * @return \Drupal\zipang_dropdown_menu\Entity\DropdownMenuEntityInterface
   *   The called Dropdown menu entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Dropdown menu entity published status indicator.
   *
   * Unpublished Dropdown menu entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Dropdown menu entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Dropdown menu entity.
   *
   * @param bool $published
   *   TRUE to set this Dropdown menu entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\zipang_dropdown_menu\Entity\DropdownMenuEntityInterface
   *   The called Dropdown menu entity entity.
   */
  public function setPublished($published);

}
