<?php

namespace Drupal\mobile_collection\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Mobile collection entities.
 *
 * @ingroup mobile_collection
 */
interface MobileCollectionInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Mobile collection name.
   *
   * @return string
   *   Name of the Mobile collection.
   */
  public function getName();

  /**
   * Sets the Mobile collection name.
   *
   * @param string $name
   *   The Mobile collection name.
   *
   * @return \Drupal\mobile_collection\Entity\MobileCollectionInterface
   *   The called Mobile collection entity.
   */
  public function setName($name);

  /**
   * Gets the Mobile collection creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Mobile collection.
   */
  public function getCreatedTime();

  /**
   * Sets the Mobile collection creation timestamp.
   *
   * @param int $timestamp
   *   The Mobile collection creation timestamp.
   *
   * @return \Drupal\mobile_collection\Entity\MobileCollectionInterface
   *   The called Mobile collection entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Mobile collection published status indicator.
   *
   * Unpublished Mobile collection are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Mobile collection is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Mobile collection.
   *
   * @param bool $published
   *   TRUE to set this Mobile collection to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\mobile_collection\Entity\MobileCollectionInterface
   *   The called Mobile collection entity.
   */
  public function setPublished($published);

}
