<?php

namespace Drupal\zipang_jackpot\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Zipang jackpot entity entities.
 *
 * @ingroup zipang_jackpot
 */
interface ZipangJackpotEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Zipang jackpot entity name.
   *
   * @return string
   *   Name of the Zipang jackpot entity.
   */
  public function getName();

  /**
   * Sets the Zipang jackpot entity name.
   *
   * @param string $name
   *   The Zipang jackpot entity name.
   *
   * @return \Drupal\zipang_jackpot\Entity\ZipangJackpotEntityInterface
   *   The called Zipang jackpot entity entity.
   */
  public function setName($name);

  /**
   * Gets the Zipang jackpot entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Zipang jackpot entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Zipang jackpot entity creation timestamp.
   *
   * @param int $timestamp
   *   The Zipang jackpot entity creation timestamp.
   *
   * @return \Drupal\zipang_jackpot\Entity\ZipangJackpotEntityInterface
   *   The called Zipang jackpot entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Zipang jackpot entity published status indicator.
   *
   * Unpublished Zipang jackpot entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Zipang jackpot entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Zipang jackpot entity.
   *
   * @param bool $published
   *   TRUE to set this Zipang jackpot entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\zipang_jackpot\Entity\ZipangJackpotEntityInterface
   *   The called Zipang jackpot entity entity.
   */
  public function setPublished($published);

}
