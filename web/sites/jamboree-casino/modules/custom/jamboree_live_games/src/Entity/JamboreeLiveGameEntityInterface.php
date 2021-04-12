<?php

namespace Drupal\jamboree_live_games\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Jamboree live game entity entities.
 *
 * @ingroup jamboree_live_games
 */
interface JamboreeLiveGameEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Jamboree live game entity name.
   *
   * @return string
   *   Name of the Jamboree live game entity.
   */
  public function getName();

  /**
   * Sets the Jamboree live game entity name.
   *
   * @param string $name
   *   The Jamboree live game entity name.
   *
   * @return \Drupal\jamboree_live_games\Entity\JamboreeLiveGameEntityInterface
   *   The called Jamboree live game entity entity.
   */
  public function setName($name);

  /**
   * Gets the Jamboree live game entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Jamboree live game entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Jamboree live game entity creation timestamp.
   *
   * @param int $timestamp
   *   The Jamboree live game entity creation timestamp.
   *
   * @return \Drupal\jamboree_live_games\Entity\JamboreeLiveGameEntityInterface
   *   The called Jamboree live game entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Jamboree live game entity published status indicator.
   *
   * Unpublished Jamboree live game entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Jamboree live game entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Jamboree live game entity.
   *
   * @param bool $published
   *   TRUE to set this Jamboree live game entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\jamboree_live_games\Entity\JamboreeLiveGameEntityInterface
   *   The called Jamboree live game entity entity.
   */
  public function setPublished($published);

}
