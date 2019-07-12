<?php

namespace Drupal\zipang_mobile_games\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Zipang mobile games entity entities.
 *
 * @ingroup zipang_mobile_games
 */
interface ZipangMobileGamesEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Zipang mobile games entity name.
   *
   * @return string
   *   Name of the Zipang mobile games entity.
   */
  public function getName();

  /**
   * Sets the Zipang mobile games entity name.
   *
   * @param string $name
   *   The Zipang mobile games entity name.
   *
   * @return \Drupal\zipang_mobile_games\Entity\ZipangMobileGamesEntityInterface
   *   The called Zipang mobile games entity entity.
   */
  public function setName($name);

  /**
   * Gets the Zipang mobile games entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Zipang mobile games entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Zipang mobile games entity creation timestamp.
   *
   * @param int $timestamp
   *   The Zipang mobile games entity creation timestamp.
   *
   * @return \Drupal\zipang_mobile_games\Entity\ZipangMobileGamesEntityInterface
   *   The called Zipang mobile games entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Zipang mobile games entity published status indicator.
   *
   * Unpublished Zipang mobile games entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Zipang mobile games entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Zipang mobile games entity.
   *
   * @param bool $published
   *   TRUE to set this Zipang mobile games entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\zipang_mobile_games\Entity\ZipangMobileGamesEntityInterface
   *   The called Zipang mobile games entity entity.
   */
  public function setPublished($published);

}
