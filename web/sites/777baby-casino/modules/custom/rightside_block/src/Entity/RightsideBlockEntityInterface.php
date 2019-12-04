<?php

namespace Drupal\rightside_block\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Rightside block entity entities.
 *
 * @ingroup rightside_block
 */
interface RightsideBlockEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Rightside block entity name.
   *
   * @return string
   *   Name of the Rightside block entity.
   */
  public function getName();

  /**
   * Sets the Rightside block entity name.
   *
   * @param string $name
   *   The Rightside block entity name.
   *
   * @return \Drupal\rightside_block\Entity\RightsideBlockEntityInterface
   *   The called Rightside block entity entity.
   */
  public function setName($name);

  /**
   * Gets the Rightside block entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Rightside block entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Rightside block entity creation timestamp.
   *
   * @param int $timestamp
   *   The Rightside block entity creation timestamp.
   *
   * @return \Drupal\rightside_block\Entity\RightsideBlockEntityInterface
   *   The called Rightside block entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Rightside block entity published status indicator.
   *
   * Unpublished Rightside block entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Rightside block entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Rightside block entity.
   *
   * @param bool $published
   *   TRUE to set this Rightside block entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\rightside_block\Entity\RightsideBlockEntityInterface
   *   The called Rightside block entity entity.
   */
  public function setPublished($published);

}
