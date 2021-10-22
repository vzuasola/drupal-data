<?php

namespace Drupal\desktop_collection\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Desktop collection entities.
 *
 * @ingroup desktop_collection
 */
interface DesktopCollectionInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Desktop collection name.
   *
   * @return string
   *   Name of the Desktop collection.
   */
  public function getName();

  /**
   * Sets the Desktop collection name.
   *
   * @param string $name
   *   The Desktop collection name.
   *
   * @return \Drupal\desktop_collection\Entity\DesktopCollectionInterface
   *   The called Desktop collection entity.
   */
  public function setName($name);

  /**
   * Gets the Desktop collection creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Desktop collection.
   */
  public function getCreatedTime();

  /**
   * Sets the Desktop collection creation timestamp.
   *
   * @param int $timestamp
   *   The Desktop collection creation timestamp.
   *
   * @return \Drupal\desktop_collection\Entity\DesktopCollectionInterface
   *   The called Desktop collection entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Desktop collection published status indicator.
   *
   * Unpublished Desktop collection are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Desktop collection is published.
   */
  public function isPublished();

  /**
   * Sets the published status of aDesktop collection.
   *
   * @param bool $published
   *   TRUE to set this Desktop collection to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\desktop_collection\Entity\DesktopCollectionInterface
   *   The called Desktop collection entity.
   */
  public function setPublished($published);

}
