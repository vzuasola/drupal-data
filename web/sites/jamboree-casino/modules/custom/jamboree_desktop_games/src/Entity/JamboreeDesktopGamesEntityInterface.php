<?php

namespace Drupal\jamboree_desktop_games\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Jamboree desktop games entity entities.
 *
 * @ingroup jamboree_desktop_games
 */
interface JamboreeDesktopGamesEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Jamboree desktop games entity name.
   *
   * @return string
   *   Name of the Jamboree desktop games entity.
   */
  public function getName();

  /**
   * Sets the Jamboree desktop games entity name.
   *
   * @param string $name
   *   The Jamboree desktop games entity name.
   *
   * @return \Drupal\jamboree_desktop_games\Entity\JamboreeDesktopGamesEntityInterface
   *   The called Jamboree desktop games entity entity.
   */
  public function setName($name);

  /**
   * Gets the Jamboree desktop games entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Jamboree desktop games entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Jamboree desktop games entity creation timestamp.
   *
   * @param int $timestamp
   *   The Jamboree desktop games entity creation timestamp.
   *
   * @return \Drupal\jamboree_desktop_games\Entity\JamboreeDesktopGamesEntityInterface
   *   The called Jamboree desktop games entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Jamboree desktop games entity published status indicator.
   *
   * Unpublished Jamboree desktop games entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Jamboree desktop games entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Jamboree desktop games entity.
   *
   * @param bool $published
   *   TRUE to set this Jamboree desktop games entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\jamboree_desktop_games\Entity\JamboreeDesktopGamesEntityInterface
   *   The called Jamboree desktop games entity entity.
   */
  public function setPublished($published);

}
