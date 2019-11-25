<?php

namespace Drupal\lucky_baby_jackpot\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Jackpot entity entities.
 *
 * @ingroup lucky_baby_jackpot
 */
interface JackpotEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Jackpot entity name.
   *
   * @return string
   *   Name of the Jackpot entity.
   */
  public function getName();

  /**
   * Sets the Jackpot entity name.
   *
   * @param string $name
   *   The Jackpot entity name.
   *
   * @return \Drupal\lucky_baby_jackpot\Entity\JackpotEntityInterface
   *   The called Jackpot entity entity.
   */
  public function setName($name);

  /**
   * Gets the Jackpot entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Jackpot entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Jackpot entity creation timestamp.
   *
   * @param int $timestamp
   *   The Jackpot entity creation timestamp.
   *
   * @return \Drupal\lucky_baby_jackpot\Entity\JackpotEntityInterface
   *   The called Jackpot entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Jackpot entity published status indicator.
   *
   * Unpublished Jackpot entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Jackpot entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Jackpot entity.
   *
   * @param bool $published
   *   TRUE to set this Jackpot entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\lucky_baby_jackpot\Entity\JackpotEntityInterface
   *   The called Jackpot entity entity.
   */
  public function setPublished($published);

}
