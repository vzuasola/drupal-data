<?php

namespace Drupal\webcomposer_right_side_block\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Inner Page Right Side Block entities.
 *
 * @ingroup webcomposer_right_side_block
 */
interface RightSideBlockEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Inner Page Right Side Block name.
   *
   * @return string
   *   Name of the Inner Page Right Side Block.
   */
  public function getName();

  /**
   * Sets the Inner Page Right Side Block name.
   *
   * @param string $name
   *   The Inner Page Right Side Block name.
   *
   * @return \Drupal\webcomposer_right_side_block\Entity\RightSideBlockEntityInterface
   *   The called Inner Page Right Side Block entity.
   */
  public function setName($name);

  /**
   * Gets the Inner Page Right Side Block creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Inner Page Right Side Block.
   */
  public function getCreatedTime();

  /**
   * Sets the Inner Page Right Side Block creation timestamp.
   *
   * @param int $timestamp
   *   The Inner Page Right Side Block creation timestamp.
   *
   * @return \Drupal\webcomposer_right_side_block\Entity\RightSideBlockEntityInterface
   *   The called Inner Page Right Side Block entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Inner Page Right Side Block published status indicator.
   *
   * Unpublished Inner Page Right Side Block are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Inner Page Right Side Block is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Inner Page Right Side Block.
   *
   * @param bool $published
   *   TRUE to set this Inner Page Right Side Block to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\webcomposer_right_side_block\Entity\RightSideBlockEntityInterface
   *   The called Inner Page Right Side Block entity.
   */
  public function setPublished($published);

}
