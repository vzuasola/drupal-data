<?php

namespace Drupal\lucky_baby_mobile_games\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Lucky baby mobile games entity entities.
 *
 * @ingroup lucky_baby_mobile_games
 */
interface LuckyBabyMobileGamesEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Lucky baby mobile games entity name.
   *
   * @return string
   *   Name of the Lucky baby mobile games entity.
   */
  public function getName();

  /**
   * Sets the Lucky baby mobile games entity name.
   *
   * @param string $name
   *   The Lucky baby mobile games entity name.
   *
   * @return \Drupal\lucky_baby_mobile_games\Entity\LuckyBabyMobileGamesEntityInterface
   *   The called Lucky baby mobile games entity entity.
   */
  public function setName($name);

  /**
   * Gets the Lucky baby mobile games entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Lucky baby mobile games entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Lucky baby mobile games entity creation timestamp.
   *
   * @param int $timestamp
   *   The Lucky baby mobile games entity creation timestamp.
   *
   * @return \Drupal\lucky_baby_mobile_games\Entity\LuckyBabyMobileGamesEntityInterface
   *   The called Lucky baby mobile games entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Lucky baby mobile games entity published status indicator.
   *
   * Unpublished Lucky baby mobile games entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Lucky baby mobile games entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Lucky baby mobile games entity.
   *
   * @param bool $published
   *   TRUE to set this Lucky baby mobile games entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\lucky_baby_mobile_games\Entity\LuckyBabyMobileGamesEntityInterface
   *   The called Lucky baby mobile games entity entity.
   */
  public function setPublished($published);

}
