<?php

namespace Drupal\jamboree_games\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Games entity entities.
 *
 * @ingroup jamboree_games
 */
interface GamesEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Games entity name.
   *
   * @return string
   *   Name of the Games entity.
   */
  public function getName();

  /**
   * Sets the Games entity name.
   *
   * @param string $name
   *   The Games entity name.
   *
   * @return \Drupal\jamboree_games\Entity\GamesEntityInterface
   *   The called Games entity entity.
   */
  public function setName($name);

  /**
   * Gets the Games entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Games entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Games entity creation timestamp.
   *
   * @param int $timestamp
   *   The Games entity creation timestamp.
   *
   * @return \Drupal\jamboree_games\Entity\GamesEntityInterface
   *   The called Games entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Games entity published status indicator.
   *
   * Unpublished Games entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Games entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Games entity.
   *
   * @param bool $published
   *   TRUE to set this Games entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\jamboree_games\Entity\GamesEntityInterface
   *   The called Games entity entity.
   */
  public function setPublished($published);

}
