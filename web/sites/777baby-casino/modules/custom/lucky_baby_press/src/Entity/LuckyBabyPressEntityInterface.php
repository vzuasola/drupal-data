<?php

namespace Drupal\lucky_baby_press\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Lucky baby press entity entities.
 *
 * @ingroup lucky_baby_press
 */
interface LuckyBabyPressEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Lucky baby press entity name.
   *
   * @return string
   *   Name of the Lucky baby press entity.
   */
  public function getName();

  /**
   * Sets the Lucky baby press entity name.
   *
   * @param string $name
   *   The Lucky baby press entity name.
   *
   * @return \Drupal\lucky_baby_press\Entity\LuckyBabyPressEntityInterface
   *   The called Lucky baby press entity entity.
   */
  public function setName($name);

  /**
   * Gets the Lucky baby press entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Lucky baby press entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Lucky baby press entity creation timestamp.
   *
   * @param int $timestamp
   *   The Lucky baby press entity creation timestamp.
   *
   * @return \Drupal\lucky_baby_press\Entity\LuckyBabyPressEntityInterface
   *   The called Lucky baby press entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Lucky baby press entity published status indicator.
   *
   * Unpublished Lucky baby press entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Lucky baby press entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Lucky baby press entity.
   *
   * @param bool $published
   *   TRUE to set this Lucky baby press entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\lucky_baby_press\Entity\LuckyBabyPressEntityInterface
   *   The called Lucky baby press entity entity.
   */
  public function setPublished($published);

}
