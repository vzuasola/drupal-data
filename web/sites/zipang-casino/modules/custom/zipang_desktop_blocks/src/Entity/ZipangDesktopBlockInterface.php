<?php

namespace Drupal\zipang_desktop_blocks\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Zipang desktop block entities.
 *
 * @ingroup zipang_desktop_blocks
 */
interface ZipangDesktopBlockInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Zipang desktop block name.
   *
   * @return string
   *   Name of the Zipang desktop block.
   */
  public function getName();

  /**
   * Sets the Zipang desktop block name.
   *
   * @param string $name
   *   The Zipang desktop block name.
   *
   * @return \Drupal\zipang_desktop_blocks\Entity\ZipangDesktopBlockInterface
   *   The called Zipang desktop block entity.
   */
  public function setName($name);

  /**
   * Gets the Zipang desktop block creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Zipang desktop block.
   */
  public function getCreatedTime();

  /**
   * Sets the Zipang desktop block creation timestamp.
   *
   * @param int $timestamp
   *   The Zipang desktop block creation timestamp.
   *
   * @return \Drupal\zipang_desktop_blocks\Entity\ZipangDesktopBlockInterface
   *   The called Zipang desktop block entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Zipang desktop block published status indicator.
   *
   * Unpublished Zipang desktop block are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Zipang desktop block is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Zipang desktop block.
   *
   * @param bool $published
   *   TRUE to set this Zipang desktop block to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\zipang_desktop_blocks\Entity\ZipangDesktopBlockInterface
   *   The called Zipang desktop block entity.
   */
  public function setPublished($published);

}
