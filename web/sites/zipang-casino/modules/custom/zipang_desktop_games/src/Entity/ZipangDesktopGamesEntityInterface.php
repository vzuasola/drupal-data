<?php

namespace Drupal\zipang_desktop_games\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Zipang desktop games entity entities.
 *
 * @ingroup zipang_desktop_games
 */
interface ZipangDesktopGamesEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Zipang desktop games entity name.
   *
   * @return string
   *   Name of the Zipang desktop games entity.
   */
  public function getName();

  /**
   * Sets the Zipang desktop games entity name.
   *
   * @param string $name
   *   The Zipang desktop games entity name.
   *
   * @return \Drupal\zipang_desktop_games\Entity\ZipangDesktopGamesEntityInterface
   *   The called Zipang desktop games entity entity.
   */
  public function setName($name);

  /**
   * Gets the Zipang desktop games entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Zipang desktop games entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Zipang desktop games entity creation timestamp.
   *
   * @param int $timestamp
   *   The Zipang desktop games entity creation timestamp.
   *
   * @return \Drupal\zipang_desktop_games\Entity\ZipangDesktopGamesEntityInterface
   *   The called Zipang desktop games entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Zipang desktop games entity published status indicator.
   *
   * Unpublished Zipang desktop games entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Zipang desktop games entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Zipang desktop games entity.
   *
   * @param bool $published
   *   TRUE to set this Zipang desktop games entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\zipang_desktop_games\Entity\ZipangDesktopGamesEntityInterface
   *   The called Zipang desktop games entity entity.
   */
  public function setPublished($published);

}
