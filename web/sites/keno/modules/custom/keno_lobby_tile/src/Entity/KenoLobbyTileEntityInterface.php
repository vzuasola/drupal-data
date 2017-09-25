<?php

namespace Drupal\keno_lobby_tile\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Keno lobby tile entity entities.
 *
 * @ingroup keno_lobby_tile
 */
interface KenoLobbyTileEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Keno lobby tile entity name.
   *
   * @return string
   *   Name of the Keno lobby tile entity.
   */
  public function getName();

  /**
   * Sets the Keno lobby tile entity name.
   *
   * @param string $name
   *   The Keno lobby tile entity name.
   *
   * @return \Drupal\keno_lobby_tile\Entity\KenoLobbyTileEntityInterface
   *   The called Keno lobby tile entity entity.
   */
  public function setName($name);

  /**
   * Gets the Keno lobby tile entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Keno lobby tile entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Keno lobby tile entity creation timestamp.
   *
   * @param int $timestamp
   *   The Keno lobby tile entity creation timestamp.
   *
   * @return \Drupal\keno_lobby_tile\Entity\KenoLobbyTileEntityInterface
   *   The called Keno lobby tile entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Keno lobby tile entity published status indicator.
   *
   * Unpublished Keno lobby tile entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Keno lobby tile entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Keno lobby tile entity.
   *
   * @param bool $published
   *   TRUE to set this Keno lobby tile entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\keno_lobby_tile\Entity\KenoLobbyTileEntityInterface
   *   The called Keno lobby tile entity entity.
   */
  public function setPublished($published);

}
