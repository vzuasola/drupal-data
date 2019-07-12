<?php

namespace Drupal\zipang_promotions\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Zipang promotions entity entities.
 *
 * @ingroup zipang_promotions
 */
interface ZipangPromotionsEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Zipang promotions entity name.
   *
   * @return string
   *   Name of the Zipang promotions entity.
   */
  public function getName();

  /**
   * Sets the Zipang promotions entity name.
   *
   * @param string $name
   *   The Zipang promotions entity name.
   *
   * @return \Drupal\zipang_promotions\Entity\ZipangPromotionsEntityInterface
   *   The called Zipang promotions entity entity.
   */
  public function setName($name);

  /**
   * Gets the Zipang promotions entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Zipang promotions entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Zipang promotions entity creation timestamp.
   *
   * @param int $timestamp
   *   The Zipang promotions entity creation timestamp.
   *
   * @return \Drupal\zipang_promotions\Entity\ZipangPromotionsEntityInterface
   *   The called Zipang promotions entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Zipang promotions entity published status indicator.
   *
   * Unpublished Zipang promotions entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Zipang promotions entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Zipang promotions entity.
   *
   * @param bool $published
   *   TRUE to set this Zipang promotions entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\zipang_promotions\Entity\ZipangPromotionsEntityInterface
   *   The called Zipang promotions entity entity.
   */
  public function setPublished($published);

}
