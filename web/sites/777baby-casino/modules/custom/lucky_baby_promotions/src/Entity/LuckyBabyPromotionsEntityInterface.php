<?php

namespace Drupal\lucky_baby_promotions\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Lucky baby promotions entity entities.
 *
 * @ingroup lucky_baby_promotions
 */
interface LuckyBabyPromotionsEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Lucky baby promotions entity name.
   *
   * @return string
   *   Name of the Lucky baby promotions entity.
   */
  public function getName();

  /**
   * Sets the Lucky baby promotions entity name.
   *
   * @param string $name
   *   The Lucky baby promotions entity name.
   *
   * @return \Drupal\lucky_baby_promotions\Entity\LuckyBabyPromotionsEntityInterface
   *   The called Lucky baby promotions entity entity.
   */
  public function setName($name);

  /**
   * Gets the Lucky baby promotions entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Lucky baby promotions entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Lucky baby promotions entity creation timestamp.
   *
   * @param int $timestamp
   *   The Lucky baby promotions entity creation timestamp.
   *
   * @return \Drupal\lucky_baby_promotions\Entity\LuckyBabyPromotionsEntityInterface
   *   The called Lucky baby promotions entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Lucky baby promotions entity published status indicator.
   *
   * Unpublished Lucky baby promotions entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Lucky baby promotions entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Lucky baby promotions entity.
   *
   * @param bool $published
   *   TRUE to set this Lucky baby promotions entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\lucky_baby_promotions\Entity\LuckyBabyPromotionsEntityInterface
   *   The called Lucky baby promotions entity entity.
   */
  public function setPublished($published);

}
