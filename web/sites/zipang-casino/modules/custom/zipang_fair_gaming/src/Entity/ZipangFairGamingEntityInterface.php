<?php

namespace Drupal\zipang_fair_gaming\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Zipang fair gaming entity entities.
 *
 * @ingroup zipang_fair_gaming
 */
interface ZipangFairGamingEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Zipang fair gaming entity name.
   *
   * @return string
   *   Name of the Zipang fair gaming entity.
   */
  public function getName();

  /**
   * Sets the Zipang fair gaming entity name.
   *
   * @param string $name
   *   The Zipang fair gaming entity name.
   *
   * @return \Drupal\zipang_fair_gaming\Entity\ZipangFairGamingEntityInterface
   *   The called Zipang fair gaming entity entity.
   */
  public function setName($name);

  /**
   * Gets the Zipang fair gaming entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Zipang fair gaming entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Zipang fair gaming entity creation timestamp.
   *
   * @param int $timestamp
   *   The Zipang fair gaming entity creation timestamp.
   *
   * @return \Drupal\zipang_fair_gaming\Entity\ZipangFairGamingEntityInterface
   *   The called Zipang fair gaming entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Zipang fair gaming entity published status indicator.
   *
   * Unpublished Zipang fair gaming entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Zipang fair gaming entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Zipang fair gaming entity.
   *
   * @param bool $published
   *   TRUE to set this Zipang fair gaming entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\zipang_fair_gaming\Entity\ZipangFairGamingEntityInterface
   *   The called Zipang fair gaming entity entity.
   */
  public function setPublished($published);

}
