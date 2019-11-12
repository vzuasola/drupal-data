<?php

namespace Drupal\lucky_baby_mobile_block\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Lucky baby mobile block entity entities.
 *
 * @ingroup lucky_baby_mobile_block
 */
interface LuckyBabyMobileBlockEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Lucky baby mobile block entity name.
   *
   * @return string
   *   Name of the Lucky baby mobile block entity.
   */
  public function getName();

  /**
   * Sets the Lucky baby mobile block entity name.
   *
   * @param string $name
   *   The Lucky baby mobile block entity name.
   *
   * @return \Drupal\lucky_baby_mobile_block\Entity\LuckyBabyMobileBlockEntityInterface
   *   The called Lucky baby mobile block entity entity.
   */
  public function setName($name);

  /**
   * Gets the Lucky baby mobile block entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Lucky baby mobile block entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Lucky baby mobile block entity creation timestamp.
   *
   * @param int $timestamp
   *   The Lucky baby mobile block entity creation timestamp.
   *
   * @return \Drupal\lucky_baby_mobile_block\Entity\LuckyBabyMobileBlockEntityInterface
   *   The called Lucky baby mobile block entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Lucky baby mobile block entity published status indicator.
   *
   * Unpublished Lucky baby mobile block entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Lucky baby mobile block entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Lucky baby mobile block entity.
   *
   * @param bool $published
   *   TRUE to set this Lucky baby mobile block entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\lucky_baby_mobile_block\Entity\LuckyBabyMobileBlockEntityInterface
   *   The called Lucky baby mobile block entity entity.
   */
  public function setPublished($published);

}
