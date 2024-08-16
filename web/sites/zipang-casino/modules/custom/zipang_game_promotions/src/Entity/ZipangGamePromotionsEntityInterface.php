<?php

namespace Drupal\zipang_game_promotions\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Zipang game promotions entity entities.
 *
 * @ingroup zipang_game_promotions
 */
interface ZipangGamePromotionsEntityInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

// Add get/set methods for your configuration properties here.

  /**
   * Gets the Zipang game promotions entity name.
   *
   * @return string
   *   Name of the Zipang game promotions entity.
   */
  public function getName();

  /**
   * Sets the Zipang game promotions entity name.
   *
   * @param string $name
   *   The Zipang game promotions entity name.
   *
   * @return \Drupal\zipang_game_promotions\Entity\ZipangGamePromotionsEntityInterface
   *   The called Zipang game promotions entity entity.
   */
  public function setName($name);

  /**
   * Gets the Zipang game promotions entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Zipang game promotions entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Zipang game promotions entity creation timestamp.
   *
   * @param int $timestamp
   *   The Zipang game promotions entity creation timestamp.
   *
   * @return \Drupal\zipang_game_promotions\Entity\ZipangGamePromotionsEntityInterface
   *   The called Zipang game promotions entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Zipang game promotions entity published status indicator.
   *
   * Unpublished Zipang game promotions entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Zipang game promotions entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Zipang game promotions entity.
   *
   * @param bool $published
   *   TRUE to set this Zipang game promotions entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\zipang_game_promotions\Entity\ZipangGamePromotionsEntityInterface
   *   The called Zipang game promotions entity entity.
   */
  public function setPublished($published);
}
