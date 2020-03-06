<?php

namespace Drupal\arcade_collection\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Arcade collection entities.
 *
 * @ingroup arcade_collection
 */
interface ArcadeCollectionInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Arcade collection name.
   *
   * @return string
   *   Name of the Arcade collection.
   */
  public function getName();

  /**
   * Sets the Arcade collection name.
   *
   * @param string $name
   *   The Arcade collection name.
   *
   * @return \Drupal\arcade_collection\Entity\ArcadeCollectionInterface
   *   The called Arcade collection entity.
   */
  public function setName($name);

  /**
   * Gets the Arcade collection creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Arcade collection.
   */
  public function getCreatedTime();

  /**
   * Sets the Arcade collection creation timestamp.
   *
   * @param int $timestamp
   *   The Arcade collection creation timestamp.
   *
   * @return \Drupal\arcade_collection\Entity\ArcadeCollectionInterface
   *   The called Arcade collection entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Arcade collection published status indicator.
   *
   * Unpublished Arcade collection are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Arcade collection is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Arcade collection.
   *
   * @param bool $published
   *   TRUE to set this Arcade collection to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\arcade_collection\Entity\ArcadeCollectionInterface
   *   The called Arcade collection entity.
   */
  public function setPublished($published);

}
