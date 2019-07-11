<?php

namespace Drupal\promotion_tiles\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Promotion tiles entities.
 *
 * @ingroup promotion_tiles
 */
interface PromotionTilesInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Promotion tiles name.
   *
   * @return string
   *   Name of the Promotion tiles.
   */
  public function getName();

  /**
   * Sets the Promotion tiles name.
   *
   * @param string $name
   *   The Promotion tiles name.
   *
   * @return \Drupal\promotion_tiles\Entity\PromotionTilesInterface
   *   The called Promotion tiles entity.
   */
  public function setName($name);

  /**
   * Gets the Promotion tiles creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Promotion tiles.
   */
  public function getCreatedTime();

  /**
   * Sets the Promotion tiles creation timestamp.
   *
   * @param int $timestamp
   *   The Promotion tiles creation timestamp.
   *
   * @return \Drupal\promotion_tiles\Entity\PromotionTilesInterface
   *   The called Promotion tiles entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Promotion tiles published status indicator.
   *
   * Unpublished Promotion tiles are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Promotion tiles is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Promotion tiles.
   *
   * @param bool $published
   *   TRUE to set this Promotion tiles to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\promotion_tiles\Entity\PromotionTilesInterface
   *   The called Promotion tiles entity.
   */
  public function setPublished($published);

}
