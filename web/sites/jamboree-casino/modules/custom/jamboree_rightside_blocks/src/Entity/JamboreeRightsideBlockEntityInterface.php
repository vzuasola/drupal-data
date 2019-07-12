<?php

namespace Drupal\jamboree_rightside_blocks\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Jamboree rightside block entity entities.
 *
 * @ingroup jamboree_rightside_blocks
 */
interface JamboreeRightsideBlockEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Jamboree rightside block entity name.
   *
   * @return string
   *   Name of the Jamboree rightside block entity.
   */
  public function getName();

  /**
   * Sets the Jamboree rightside block entity name.
   *
   * @param string $name
   *   The Jamboree rightside block entity name.
   *
   * @return \Drupal\jamboree_rightside_blocks\Entity\JamboreeRightsideBlockEntityInterface
   *   The called Jamboree rightside block entity entity.
   */
  public function setName($name);

  /**
   * Gets the Jamboree rightside block entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Jamboree rightside block entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Jamboree rightside block entity creation timestamp.
   *
   * @param int $timestamp
   *   The Jamboree rightside block entity creation timestamp.
   *
   * @return \Drupal\jamboree_rightside_blocks\Entity\JamboreeRightsideBlockEntityInterface
   *   The called Jamboree rightside block entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Jamboree rightside block entity published status indicator.
   *
   * Unpublished Jamboree rightside block entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Jamboree rightside block entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Jamboree rightside block entity.
   *
   * @param bool $published
   *   TRUE to set this Jamboree rightside block entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\jamboree_rightside_blocks\Entity\JamboreeRightsideBlockEntityInterface
   *   The called Jamboree rightside block entity entity.
   */
  public function setPublished($published);

}
