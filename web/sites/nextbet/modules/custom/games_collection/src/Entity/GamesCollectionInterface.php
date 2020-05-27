<?php

namespace Drupal\games_collection\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Games Collection entities.
 *
 * @ingroup games_collection
 */
interface GamesCollectionInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Games Collection name.
   *
   * @return string
   *   Name of the Games Collection.
   */
  public function getName();

  /**
   * Sets the Games Collection name.
   *
   * @param string $name
   *   The Games Collection name.
   *
   * @return \Drupal\games_collection\Entity\GamesCollectionInterface
   *   The called Games Collection entity.
   */
  public function setName($name);

  /**
   * Gets the Games Collection creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Games Collection.
   */
  public function getCreatedTime();

  /**
   * Sets the Games Collection creation timestamp.
   *
   * @param int $timestamp
   *   The Games Collection creation timestamp.
   *
   * @return \Drupal\games_collection\Entity\GamesCollectionInterface
   *   The called Games Collection entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Games Collection published status indicator.
   *
   * Unpublished Games Collection are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Games Collection is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Games Collection.
   *
   * @param bool $published
   *   TRUE to set this Games Collection to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\games_collection\Entity\GamesCollectionInterface
   *   The called Games Collection entity.
   */
  public function setPublished($published);

}
