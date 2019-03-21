<?php

namespace Drupal\zipang_rightside_blocks\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Zipang rightside block entity entities.
 *
 * @ingroup zipang_rightside_blocks
 */
interface ZipangRightsideBlockEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Zipang rightside block entity name.
   *
   * @return string
   *   Name of the Zipang rightside block entity.
   */
  public function getName();

  /**
   * Sets the Zipang rightside block entity name.
   *
   * @param string $name
   *   The Zipang rightside block entity name.
   *
   * @return \Drupal\zipang_rightside_blocks\Entity\ZipangRightsideBlockEntityInterface
   *   The called Zipang rightside block entity entity.
   */
  public function setName($name);

  /**
   * Gets the Zipang rightside block entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Zipang rightside block entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Zipang rightside block entity creation timestamp.
   *
   * @param int $timestamp
   *   The Zipang rightside block entity creation timestamp.
   *
   * @return \Drupal\zipang_rightside_blocks\Entity\ZipangRightsideBlockEntityInterface
   *   The called Zipang rightside block entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Zipang rightside block entity published status indicator.
   *
   * Unpublished Zipang rightside block entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Zipang rightside block entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Zipang rightside block entity.
   *
   * @param bool $published
   *   TRUE to set this Zipang rightside block entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\zipang_rightside_blocks\Entity\ZipangRightsideBlockEntityInterface
   *   The called Zipang rightside block entity entity.
   */
  public function setPublished($published);

}
