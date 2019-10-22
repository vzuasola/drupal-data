<?php

namespace Drupal\lucky_baby_desktop_block\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Lucky baby desktop block entity entities.
 *
 * @ingroup lucky_baby_desktop_block
 */
interface LuckyBabyDesktopBlockEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Lucky baby desktop block entity name.
   *
   * @return string
   *   Name of the Lucky baby desktop block entity.
   */
  public function getName();

  /**
   * Sets the Lucky baby desktop block entity name.
   *
   * @param string $name
   *   The Lucky baby desktop block entity name.
   *
   * @return \Drupal\lucky_baby_desktop_block\Entity\LuckyBabyDesktopBlockEntityInterface
   *   The called Lucky baby desktop block entity entity.
   */
  public function setName($name);

  /**
   * Gets the Lucky baby desktop block entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Lucky baby desktop block entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Lucky baby desktop block entity creation timestamp.
   *
   * @param int $timestamp
   *   The Lucky baby desktop block entity creation timestamp.
   *
   * @return \Drupal\lucky_baby_desktop_block\Entity\LuckyBabyDesktopBlockEntityInterface
   *   The called Lucky baby desktop block entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Lucky baby desktop block entity published status indicator.
   *
   * Unpublished Lucky baby desktop block entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Lucky baby desktop block entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Lucky baby desktop block entity.
   *
   * @param bool $published
   *   TRUE to set this Lucky baby desktop block entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\lucky_baby_desktop_block\Entity\LuckyBabyDesktopBlockEntityInterface
   *   The called Lucky baby desktop block entity entity.
   */
  public function setPublished($published);

}
