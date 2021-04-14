<?php

namespace Drupal\jamboree_all_games_config\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Jamboree all games entity entities.
 *
 * @ingroup jamboree_all_games_config
 */
interface JamboreeAllGamesEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Jamboree all games entity name.
   *
   * @return string
   *   Name of the Jamboree all games entity.
   */
  public function getName();

  /**
   * Sets the Jamboree all games entity name.
   *
   * @param string $name
   *   The Jamboree all games entity name.
   *
   * @return \Drupal\jamboree_all_games_config\Entity\JamboreeAllGamesEntityInterface
   *   The called Jamboree all games entity entity.
   */
  public function setName($name);

  /**
   * Gets the Jamboree all games entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Jamboree all games entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Jamboree all games entity creation timestamp.
   *
   * @param int $timestamp
   *   The Jamboree all games entity creation timestamp.
   *
   * @return \Drupal\jamboree_all_games_config\Entity\JamboreeAllGamesEntityInterface
   *   The called Jamboree all games entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Jamboree all games entity published status indicator.
   *
   * Unpublished Jamboree all games entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Jamboree all games entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Jamboree all games entity.
   *
   * @param bool $published
   *   TRUE to set this Jamboree all games entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\jamboree_all_games_config\Entity\JamboreeAllGamesEntityInterface
   *   The called Jamboree all games entity entity.
   */
  public function setPublished($published);

}
