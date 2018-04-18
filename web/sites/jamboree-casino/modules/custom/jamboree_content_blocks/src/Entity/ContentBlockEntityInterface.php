<?php

namespace Drupal\jamboree_content_blocks\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Content block entity entities.
 *
 * @ingroup jamboree_content_blocks
 */
interface ContentBlockEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Content block entity name.
   *
   * @return string
   *   Name of the Content block entity.
   */
  public function getName();

  /**
   * Sets the Content block entity name.
   *
   * @param string $name
   *   The Content block entity name.
   *
   * @return \Drupal\jamboree_content_blocks\Entity\ContentBlockEntityInterface
   *   The called Content block entity entity.
   */
  public function setName($name);

  /**
   * Gets the Content block entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Content block entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Content block entity creation timestamp.
   *
   * @param int $timestamp
   *   The Content block entity creation timestamp.
   *
   * @return \Drupal\jamboree_content_blocks\Entity\ContentBlockEntityInterface
   *   The called Content block entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Content block entity published status indicator.
   *
   * Unpublished Content block entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Content block entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Content block entity.
   *
   * @param bool $published
   *   TRUE to set this Content block entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\jamboree_content_blocks\Entity\ContentBlockEntityInterface
   *   The called Content block entity entity.
   */
  public function setPublished($published);

}
