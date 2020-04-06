<?php

namespace Drupal\lucky_baby_weekly_winner\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Lucky baby weekly winner entity entities.
 *
 * @ingroup lucky_baby_weekly_winner
 */
interface LuckyBabyWeeklyWinnerEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Lucky baby weekly winner entity name.
   *
   * @return string
   *   Name of the Lucky baby weekly winner entity.
   */
  public function getName();

  /**
   * Sets the Lucky baby weekly winner entity name.
   *
   * @param string $name
   *   The Lucky baby weekly winner entity name.
   *
   * @return \Drupal\lucky_baby_weekly_winner\Entity\LuckyBabyWeeklyWinnerEntityInterface
   *   The called Lucky baby weekly winner entity entity.
   */
  public function setName($name);

  /**
   * Gets the Lucky baby weekly winner entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Lucky baby weekly winner entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Lucky baby weekly winner entity creation timestamp.
   *
   * @param int $timestamp
   *   The Lucky baby weekly winner entity creation timestamp.
   *
   * @return \Drupal\lucky_baby_weekly_winner\Entity\LuckyBabyWeeklyWinnerEntityInterface
   *   The called Lucky baby weekly winner entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Lucky baby weekly winner entity published status indicator.
   *
   * Unpublished Lucky baby weekly winner entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Lucky baby weekly winner entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Lucky baby weekly winner entity.
   *
   * @param bool $published
   *   TRUE to set this Lucky baby weekly winner entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\lucky_baby_weekly_winner\Entity\LuckyBabyWeeklyWinnerEntityInterface
   *   The called Lucky baby weekly winner entity entity.
   */
  public function setPublished($published);

}
