<?php

namespace Drupal\zipang_weekly_winner\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Zipang weekly winner entity entities.
 *
 * @ingroup zipang_weekly_winner
 */
interface ZipangWeeklyWinnerEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Zipang weekly winner entity name.
   *
   * @return string
   *   Name of the Zipang weekly winner entity.
   */
  public function getName();

  /**
   * Sets the Zipang weekly winner entity name.
   *
   * @param string $name
   *   The Zipang weekly winner entity name.
   *
   * @return \Drupal\zipang_weekly_winner\Entity\ZipangWeeklyWinnerEntityInterface
   *   The called Zipang weekly winner entity entity.
   */
  public function setName($name);

  /**
   * Gets the Zipang weekly winner entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Zipang weekly winner entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Zipang weekly winner entity creation timestamp.
   *
   * @param int $timestamp
   *   The Zipang weekly winner entity creation timestamp.
   *
   * @return \Drupal\zipang_weekly_winner\Entity\ZipangWeeklyWinnerEntityInterface
   *   The called Zipang weekly winner entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Zipang weekly winner entity published status indicator.
   *
   * Unpublished Zipang weekly winner entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Zipang weekly winner entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Zipang weekly winner entity.
   *
   * @param bool $published
   *   TRUE to set this Zipang weekly winner entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\zipang_weekly_winner\Entity\ZipangWeeklyWinnerEntityInterface
   *   The called Zipang weekly winner entity entity.
   */
  public function setPublished($published);

}
