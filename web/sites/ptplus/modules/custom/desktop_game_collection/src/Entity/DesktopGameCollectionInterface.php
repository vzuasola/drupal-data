<?php

namespace Drupal\desktop_game_collection\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for definingDesktop game collection entities.
 *
 * @ingroup desktop_game_collection
 */
interface DesktopGameCollectionInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface { 
   
  // Add get/set methods for your configuration properties here.

  /**
   * Gets theDesktop game collection name.
   *
   * @return string
   *   Name of theDesktop game collection.
   */
  public function getName();

  /**
   * Sets theDesktop game collection name.
   *
   * @param string $name
   *   TheDesktop game collection name.
   *
   * @return \Drupal\desktop_game_collection\Entity\DesktopGameCollectionInterface
   *   The calledDesktop game collection entity.
   */
  public function setName($name);

  /**
   * Gets theDesktop game collection creation timestamp.
   *
   * @return int
   *   Creation timestamp of theDesktop game collection.
   */
  public function getCreatedTime();

  /**
   * Sets theDesktop game collection creation timestamp.
   *
   * @param int $timestamp
   *   TheDesktop game collection creation timestamp.
   *
   * @return \Drupal\desktop_game_collection\Entity\DesktopGameCollectionInterface
   *   The calledDesktop game collection entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns theDesktop game collection published status indicator.
   *
   * UnpublishedDesktop game collection are only visible to restricted users.
   *
   * @return bool
   *   TRUE if theDesktop game collection is published.
   */
  public function isPublished();

  /**
   * Sets the published status of aDesktop game collection.
   *
   * @param bool $published
   *   TRUE to set thisDesktop game collection to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\desktop_game_collection\Entity\DesktopGameCollectionInterface
   *   The calledDesktop game collection entity.
   */
  public function setPublished($published);

}
