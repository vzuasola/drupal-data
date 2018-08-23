<?php

namespace Drupal\poker_video_support\Entity;

use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\RevisionableInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Video entity entities.
 *
 * @ingroup poker_video_support
 */
interface VideoEntityInterface extends RevisionableInterface,
  RevisionLogInterface,
  EntityChangedInterface,
  EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Video entity name.
   *
   * @return string
   *   Name of the Video entity.
   */
  public function getName();

  /**
   * Sets the Video entity name.
   *
   * @param string $name
   *   The Video entity name.
   *
   * @return \Drupal\poker_video_support\Entity\VideoEntityInterface
   *   The called Video entity entity.
   */
  public function setName($name);

  /**
   * Gets the Video entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Video entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Video entity creation timestamp.
   *
   * @param int $timestamp
   *   The Video entity creation timestamp.
   *
   * @return \Drupal\poker_video_support\Entity\VideoEntityInterface
   *   The called Video entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Video entity published status indicator.
   *
   * Unpublished Video entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Video entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Video entity.
   *
   * @param bool $published
   *   TRUE to set this Video entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\poker_video_support\Entity\VideoEntityInterface
   *   The called Video entity entity.
   */
  public function setPublished($published);

  /**
   * Gets the Video entity revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Video entity revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\poker_video_support\Entity\VideoEntityInterface
   *   The called Video entity entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Video entity revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Video entity revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\poker_video_support\Entity\VideoEntityInterface
   *   The called Video entity entity.
   */
  public function setRevisionUserId($uid);

}
