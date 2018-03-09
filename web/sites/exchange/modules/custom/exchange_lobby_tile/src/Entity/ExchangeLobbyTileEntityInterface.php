<?php

namespace Drupal\exchange_lobby_tile\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining exchange lobby tile entity entities.
 *
 * @ingroup exchange_lobby_tile
 */
interface ExchangeLobbyTileEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the exchange lobby tile entity name.
   *
   * @return string
   *   Name of the exchange lobby tile entity.
   */
  public function getName();

  /**
   * Sets the exchange lobby tile entity name.
   *
   * @param string $name
   *   The exchange lobby tile entity name.
   *
   * @return \Drupal\exchange_lobby_tile\Entity\ExchangeLobbyTileEntityInterface
   *   The called exchange lobby tile entity entity.
   */
  public function setName($name);

  /**
   * Gets the exchange lobby tile entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the exchange lobby tile entity.
   */
  public function getCreatedTime();

  /**
   * Sets the exchange lobby tile entity creation timestamp.
   *
   * @param int $timestamp
   *   The exchange lobby tile entity creation timestamp.
   *
   * @return \Drupal\exchange_lobby_tile\Entity\ExchangeLobbyTileEntityInterface
   *   The called exchange lobby tile entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the exchange lobby tile entity published status indicator.
   *
   * Unpublished exchange lobby tile entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the exchange lobby tile entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a exchange lobby tile entity.
   *
   * @param bool $published
   *   TRUE to set this exchange lobby tile entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\exchange_lobby_tile\Entity\ExchangeLobbyTileEntityInterface
   *   The called exchange lobby tile entity entity.
   */
  public function setPublished($published);

}
