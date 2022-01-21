<?php

namespace Drupal\lobby_product_tiles\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Lobby Product Tiles entities.
 *
 * @ingroup lobby_product_tiles
 */
interface LobbyProductTilesInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Lobby Product Tiles name.
   *
   * @return string
   *   Name of the Lobby Product Tiles.
   */
  public function getName();

  /**
   * Sets the Lobby Product Tiles name.
   *
   * @param string $name
   *   The Lobby Product Tiles name.
   *
   * @return \Drupal\lobby_product_tiles\Entity\LobbyProductTilesInterface
   *   The called Lobby Product Tiles entity.
   */
  public function setName($name);

  /**
   * Gets the Lobby Product Tiles creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Lobby Product Tiles.
   */
  public function getCreatedTime();

  /**
   * Sets the Lobby Product Tiles creation timestamp.
   *
   * @param int $timestamp
   *   The Lobby Product Tiles creation timestamp.
   *
   * @return \Drupal\lobby_product_tiles\Entity\LobbyProductTilesInterface
   *   The called Lobby Product Tiles entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Lobby Product Tiles published status indicator.
   *
   * Unpublished Lobby Product Tiles are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Lobby Product Tiles is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Lobby Product Tiles.
   *
   * @param bool $published
   *   TRUE to set this Lobby Product Tiles to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\lobby_product_tiles\Entity\LobbyProductTilesInterface
   *   The called Lobby Product Tiles entity.
   */
  public function setPublished($published);

}
