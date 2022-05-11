<?php

namespace Drupal\lucky_baby_all_games_config\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Lucky Baby all games entity entities.
 *
 * @ingroup lucky_baby_all_games_config
 */
interface LuckyBabyAllGamesEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Lucky Baby all games entity name.
   *
   * @return string
   *   Name of the Lucky Baby all games entity.
   */
  public function getName();

  /**
   * Sets the Lucky Baby all games entity name.
   *
   * @param string $name
   *   The Lucky Baby all games entity name.
   *
   * @return \Drupal\lucky_baby_all_games_config\Entity\LuckyBabyAllGamesEntityInterface
   *   The called Lucky Baby all games entity entity.
   */
  public function setName($name);

  /**
   * Gets the Lucky Baby all games entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Lucky Baby all games entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Lucky Baby all games entity creation timestamp.
   *
   * @param int $timestamp
   *   The Lucky Baby all games entity creation timestamp.
   *
   * @return \Drupal\lucky_baby_all_games_config\Entity\LuckyBabyAllGamesEntityInterface
   *   The called Lucky Baby all games entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Lucky Baby all games entity published status indicator.
   *
   * Unpublished Lucky Baby all games entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Lucky Baby all games entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Lucky Baby all games entity.
   *
   * @param bool $published
   *   TRUE to set this Lucky Baby all games entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\lucky_baby_all_games_config\Entity\Lucky BabyAllGamesEntityInterface
   *   The called Lucky Baby all games entity entity.
   */
  public function setPublished($published);

}
