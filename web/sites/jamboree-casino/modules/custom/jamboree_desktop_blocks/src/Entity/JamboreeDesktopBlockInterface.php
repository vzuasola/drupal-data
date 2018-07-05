<?php

namespace Drupal\jamboree_desktop_blocks\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Jamboree desktop block entities.
 *
 * @ingroup jamboree_desktop_blocks
 */
interface JamboreeDesktopBlockInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Jamboree desktop block name.
   *
   * @return string
   *   Name of the Jamboree desktop block.
   */
  public function getName();

  /**
   * Sets the Jamboree desktop block name.
   *
   * @param string $name
   *   The Jamboree desktop block name.
   *
   * @return \Drupal\jamboree_desktop_blocks\Entity\JamboreeDesktopBlockInterface
   *   The called Jamboree desktop block entity.
   */
  public function setName($name);

  /**
   * Gets the Jamboree desktop block creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Jamboree desktop block.
   */
  public function getCreatedTime();

  /**
   * Sets the Jamboree desktop block creation timestamp.
   *
   * @param int $timestamp
   *   The Jamboree desktop block creation timestamp.
   *
   * @return \Drupal\jamboree_desktop_blocks\Entity\JamboreeDesktopBlockInterface
   *   The called Jamboree desktop block entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Jamboree desktop block published status indicator.
   *
   * Unpublished Jamboree desktop block are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Jamboree desktop block is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Jamboree desktop block.
   *
   * @param bool $published
   *   TRUE to set this Jamboree desktop block to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\jamboree_desktop_blocks\Entity\JamboreeDesktopBlockInterface
   *   The called Jamboree desktop block entity.
   */
  public function setPublished($published);

}
