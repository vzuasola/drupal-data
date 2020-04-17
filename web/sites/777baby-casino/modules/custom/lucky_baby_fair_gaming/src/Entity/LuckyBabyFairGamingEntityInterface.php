<?php

namespace Drupal\lucky_baby_fair_gaming\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Lucky baby fair gaming entity entities.
 *
 * @ingroup lucky_baby_fair_gaming
 */
interface LuckyBabyFairGamingEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Lucky baby fair gaming entity name.
   *
   * @return string
   *   Name of the Lucky baby fair gaming entity.
   */
  public function getName();

  /**
   * Sets the Lucky baby fair gaming entity name.
   *
   * @param string $name
   *   The Lucky baby fair gaming entity name.
   *
   * @return \Drupal\lucky_baby_fair_gaming\Entity\LuckyBabyFairGamingEntityInterface
   *   The called Lucky baby fair gaming entity entity.
   */
  public function setName($name);

  /**
   * Gets the Lucky baby fair gaming entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Lucky baby fair gaming entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Lucky baby fair gaming entity creation timestamp.
   *
   * @param int $timestamp
   *   The Lucky baby fair gaming entity creation timestamp.
   *
   * @return \Drupal\lucky_baby_fair_gaming\Entity\LuckyBabyFairGamingEntityInterface
   *   The called Lucky baby fair gaming entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Lucky baby fair gaming entity published status indicator.
   *
   * Unpublished Lucky baby fair gaming entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Lucky baby fair gaming entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Lucky baby fair gaming entity.
   *
   * @param bool $published
   *   TRUE to set this Lucky baby fair gaming entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\lucky_baby_fair_gaming\Entity\LuckyBabyFairGamingEntityInterface
   *   The called Lucky baby fair gaming entity entity.
   */
  public function setPublished($published);

}
