<?php

namespace Drupal\zipang_special_promotions_notif\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Zipang special promotions entity entities.
 *
 * @ingroup zipang_special_promotions_notif
 */
interface ZipangSpecialPromotionsEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Zipang special promotions entity name.
   *
   * @return string
   *   Name of the Zipang special promotions entity.
   */
  public function getName();

  /**
   * Sets the Zipang special promotions entity name.
   *
   * @param string $name
   *   The Zipang special promotions entity name.
   *
   * @return \Drupal\zipang_special_promotions_notif\Entity\ZipangSpecialPromotionsEntityInterface
   *   The called Zipang special promotions entity entity.
   */
  public function setName($name);

  /**
   * Gets the Zipang special promotions entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Zipang special promotions entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Zipang special promotions entity creation timestamp.
   *
   * @param int $timestamp
   *   The Zipang special promotions entity creation timestamp.
   *
   * @return \Drupal\zipang_special_promotions_notif\Entity\ZipangSpecialPromotionsEntityInterface
   *   The called Zipang special promotions entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Zipang special promotions entity published status indicator.
   *
   * Unpublished Zipang special promotions entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Zipang special promotions entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Zipang special promotions entity.
   *
   * @param bool $published
   *   TRUE to set this Zipang special promotions entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\zipang_special_promotions_notif\Entity\ZipangSpecialPromotionsEntityInterface
   *   The called Zipang special promotions entity entity.
   */
  public function setPublished($published);

}
