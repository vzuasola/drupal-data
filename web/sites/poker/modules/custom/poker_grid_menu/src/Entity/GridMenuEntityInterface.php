<?php

namespace Drupal\poker_grid_menu\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Grid menu entity entities.
 *
 * @ingroup poker_grid_menu
 */
interface GridMenuEntityInterface extends ContentEntityInterface, RevisionLogInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Grid menu entity name.
   *
   * @return string
   *   Name of the Grid menu entity.
   */
  public function getName();

  /**
   * Sets the Grid menu entity name.
   *
   * @param string $name
   *   The Grid menu entity name.
   *
   * @return \Drupal\poker_grid_menu\Entity\GridMenuEntityInterface
   *   The called Grid menu entity entity.
   */
  public function setName($name);

  /**
   * Gets the Grid menu entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Grid menu entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Grid menu entity creation timestamp.
   *
   * @param int $timestamp
   *   The Grid menu entity creation timestamp.
   *
   * @return \Drupal\poker_grid_menu\Entity\GridMenuEntityInterface
   *   The called Grid menu entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Grid menu entity published status indicator.
   *
   * Unpublished Grid menu entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Grid menu entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Grid menu entity.
   *
   * @param bool $published
   *   TRUE to set this Grid menu entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\poker_grid_menu\Entity\GridMenuEntityInterface
   *   The called Grid menu entity entity.
   */
  public function setPublished($published);

  /**
   * Gets the Grid menu entity revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Grid menu entity revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\poker_grid_menu\Entity\GridMenuEntityInterface
   *   The called Grid menu entity entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Grid menu entity revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Grid menu entity revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\poker_grid_menu\Entity\GridMenuEntityInterface
   *   The called Grid menu entity entity.
   */
  public function setRevisionUserId($uid);

}
