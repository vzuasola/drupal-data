<?php

namespace Drupal\client_footer_games\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Client footer games entities.
 *
 * @ingroup client_footer_games
 */
interface ClientFooterGamesInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Client footer games name.
   *
   * @return string
   *   Name of the Client footer games.
   */
  public function getName();

  /**
   * Sets the Client footer games name.
   *
   * @param string $name
   *   The Client footer games name.
   *
   * @return \Drupal\client_footer_games\Entity\ClientFooterGamesInterface
   *   The called Client footer games entity.
   */
  public function setName($name);

  /**
   * Gets the Client footer games creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Client footer games.
   */
  public function getCreatedTime();

  /**
   * Sets the Client footer games creation timestamp.
   *
   * @param int $timestamp
   *   The Client footer games creation timestamp.
   *
   * @return \Drupal\client_footer_games\Entity\ClientFooterGamesInterface
   *   The called Client footer games entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Client footer games published status indicator.
   *
   * Unpublished Client footer games are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Client footer games is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Client footer games.
   *
   * @param bool $published
   *   TRUE to set this Client footer games to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\client_footer_games\Entity\ClientFooterGamesInterface
   *   The called Client footer games entity.
   */
  public function setPublished($published);

}
