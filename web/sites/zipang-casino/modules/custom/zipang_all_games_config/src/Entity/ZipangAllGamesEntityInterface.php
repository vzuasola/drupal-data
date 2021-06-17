<?php

namespace Drupal\zipang_all_games_config\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Zipang all games entity entities.
 *
 * @ingroup zipang_all_games_config
 */
interface ZipangAllGamesEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Zipang all games entity name.
   *
   * @return string
   *   Name of the Zipang all games entity.
   */
  public function getName();

  /**
   * Sets the Zipang all games entity name.
   *
   * @param string $name
   *   The Zipang all games entity name.
   *
   * @return \Drupal\zipang_all_games_config\Entity\ZipangAllGamesEntityInterface
   *   The called Zipang all games entity entity.
   */
  public function setName($name);

  /**
   * Gets the Zipang all games entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Zipang all games entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Zipang all games entity creation timestamp.
   *
   * @param int $timestamp
   *   The Zipang all games entity creation timestamp.
   *
   * @return \Drupal\zipang_all_games_config\Entity\ZipangAllGamesEntityInterface
   *   The called Zipang all games entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Zipang all games entity published status indicator.
   *
   * Unpublished Zipang all games entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Zipang all games entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Zipang all games entity.
   *
   * @param bool $published
   *   TRUE to set this Zipang all games entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\zipang_all_games_config\Entity\ZipangAllGamesEntityInterface
   *   The called Zipang all games entity entity.
   */
  public function setPublished($published);

}
