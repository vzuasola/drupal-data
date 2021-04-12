<?php

namespace Drupal\jamboree_arcade\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Jamboree arcade game entity entities.
 *
 * @ingroup jamboree_arcade
 */
interface JamboreeArcadeGameEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Jamboree arcade game entity name.
   *
   * @return string
   *   Name of the Jamboree arcade game entity.
   */
  public function getName();

  /**
   * Sets the Jamboree arcade game entity name.
   *
   * @param string $name
   *   The Jamboree arcade game entity name.
   *
   * @return \Drupal\jamboree_arcade\Entity\JamboreeArcadeGameEntityInterface
   *   The called Jamboree arcade game entity entity.
   */
  public function setName($name);

  /**
   * Gets the Jamboree arcade game entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Jamboree arcade game entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Jamboree arcade game entity creation timestamp.
   *
   * @param int $timestamp
   *   The Jamboree arcade game entity creation timestamp.
   *
   * @return \Drupal\jamboree_arcade\Entity\JamboreeArcadeGameEntityInterface
   *   The called Jamboree arcade game entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Jamboree arcade game entity published status indicator.
   *
   * Unpublished Jamboree arcade game entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Jamboree arcade game entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Jamboree arcade game entity.
   *
   * @param bool $published
   *   TRUE to set this Jamboree arcade game entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\jamboree_arcade\Entity\JamboreeArcadeGameEntityInterface
   *   The called Jamboree arcade game entity entity.
   */
  public function setPublished($published);

}
