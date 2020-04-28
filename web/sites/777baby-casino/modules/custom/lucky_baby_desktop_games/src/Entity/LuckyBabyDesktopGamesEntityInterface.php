<?php

namespace Drupal\lucky_baby_desktop_games\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Lucky baby desktop games entity entities.
 *
 * @ingroup lucky_baby_desktop_games
 */
interface LuckyBabyDesktopGamesEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Lucky baby desktop games entity name.
   *
   * @return string
   *   Name of the Lucky baby desktop games entity.
   */
  public function getName();

  /**
   * Sets the Lucky baby desktop games entity name.
   *
   * @param string $name
   *   The Lucky baby desktop games entity name.
   *
   * @return \Drupal\lucky_baby_desktop_games\Entity\LuckyBabyDesktopGamesEntityInterface
   *   The called Lucky baby desktop games entity entity.
   */
  public function setName($name);

  /**
   * Gets the Lucky baby desktop games entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Lucky baby desktop games entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Lucky baby desktop games entity creation timestamp.
   *
   * @param int $timestamp
   *   The Lucky baby desktop games entity creation timestamp.
   *
   * @return \Drupal\lucky_baby_desktop_games\Entity\LuckyBabyDesktopGamesEntityInterface
   *   The called Lucky baby desktop games entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Lucky baby desktop games entity published status indicator.
   *
   * Unpublished Lucky baby desktop games entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Lucky baby desktop games entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Lucky baby desktop games entity.
   *
   * @param bool $published
   *   TRUE to set this Lucky baby desktop games entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\lucky_baby_desktop_games\Entity\LuckyBabyDesktopGamesEntityInterface
   *   The called Lucky baby desktop games entity entity.
   */
  public function setPublished($published);

}
