<?php

namespace Drupal\jamboree_mobile_games\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Jamboree mobile games entity entities.
 *
 * @ingroup jamboree_mobile_games
 */
interface JamboreeMobileGamesEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Jamboree mobile games entity name.
   *
   * @return string
   *   Name of the Jamboree mobile games entity.
   */
  public function getName();

  /**
   * Sets the Jamboree mobile games entity name.
   *
   * @param string $name
   *   The Jamboree mobile games entity name.
   *
   * @return \Drupal\jamboree_mobile_games\Entity\JamboreeMobileGamesEntityInterface
   *   The called Jamboree mobile games entity entity.
   */
  public function setName($name);

  /**
   * Gets the Jamboree mobile games entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Jamboree mobile games entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Jamboree mobile games entity creation timestamp.
   *
   * @param int $timestamp
   *   The Jamboree mobile games entity creation timestamp.
   *
   * @return \Drupal\jamboree_mobile_games\Entity\JamboreeMobileGamesEntityInterface
   *   The called Jamboree mobile games entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Jamboree mobile games entity published status indicator.
   *
   * Unpublished Jamboree mobile games entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Jamboree mobile games entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Jamboree mobile games entity.
   *
   * @param bool $published
   *   TRUE to set this Jamboree mobile games entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\jamboree_mobile_games\Entity\JamboreeMobileGamesEntityInterface
   *   The called Jamboree mobile games entity entity.
   */
  public function setPublished($published);

}
