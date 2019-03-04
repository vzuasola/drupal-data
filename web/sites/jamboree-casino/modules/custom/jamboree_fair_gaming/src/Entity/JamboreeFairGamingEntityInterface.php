<?php

namespace Drupal\jamboree_fair_gaming\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Jamboree fair gaming entity entities.
 *
 * @ingroup jamboree_fair_gaming
 */
interface JamboreeFairGamingEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Jamboree fair gaming entity name.
   *
   * @return string
   *   Name of the Jamboree fair gaming entity.
   */
  public function getName();

  /**
   * Sets the Jamboree fair gaming entity name.
   *
   * @param string $name
   *   The Jamboree fair gaming entity name.
   *
   * @return \Drupal\jamboree_fair_gaming\Entity\JamboreeFairGamingEntityInterface
   *   The called Jamboree fair gaming entity entity.
   */
  public function setName($name);

  /**
   * Gets the Jamboree fair gaming entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Jamboree fair gaming entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Jamboree fair gaming entity creation timestamp.
   *
   * @param int $timestamp
   *   The Jamboree fair gaming entity creation timestamp.
   *
   * @return \Drupal\jamboree_fair_gaming\Entity\JamboreeFairGamingEntityInterface
   *   The called Jamboree fair gaming entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Jamboree fair gaming entity published status indicator.
   *
   * Unpublished Jamboree fair gaming entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Jamboree fair gaming entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Jamboree fair gaming entity.
   *
   * @param bool $published
   *   TRUE to set this Jamboree fair gaming entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\jamboree_fair_gaming\Entity\JamboreeFairGamingEntityInterface
   *   The called Jamboree fair gaming entity entity.
   */
  public function setPublished($published);

}
