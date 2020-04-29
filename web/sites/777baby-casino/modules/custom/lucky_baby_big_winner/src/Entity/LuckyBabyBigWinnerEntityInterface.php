<?php

namespace Drupal\lucky_baby_big_winner\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Lucky baby big winner entity entities.
 *
 * @ingroup lucky_baby_big_winner
 */
interface LuckyBabyBigWinnerEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Lucky baby big winner entity name.
   *
   * @return string
   *   Name of the Lucky baby big winner entity.
   */
  public function getName();

  /**
   * Sets the Lucky baby big winner entity name.
   *
   * @param string $name
   *   The Lucky baby big winner entity name.
   *
   * @return \Drupal\lucky_baby_big_winner\Entity\LuckyBabyBigWinnerEntityInterface
   *   The called Lucky baby big winner entity entity.
   */
  public function setName($name);

  /**
   * Gets the Lucky baby big winner entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Lucky baby big winner entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Lucky baby big winner entity creation timestamp.
   *
   * @param int $timestamp
   *   The Lucky baby big winner entity creation timestamp.
   *
   * @return \Drupal\lucky_baby_big_winner\Entity\LuckyBabyBigWinnerEntityInterface
   *   The called Lucky baby big winner entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Lucky baby big winner entity published status indicator.
   *
   * Unpublished Lucky baby big winner entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Lucky baby big winner entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Lucky baby big winner entity.
   *
   * @param bool $published
   *   TRUE to set this Lucky baby big winner entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\lucky_baby_big_winner\Entity\LuckyBabyBigWinnerEntityInterface
   *   The called Lucky baby big winner entity entity.
   */
  public function setPublished($published);

}
