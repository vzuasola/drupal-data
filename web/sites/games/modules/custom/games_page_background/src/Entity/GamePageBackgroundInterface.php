<?php

namespace Drupal\games_page_background\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Game Page Background entities.
 *
 * @ingroup games_page_background
 */
interface GamePageBackgroundInterface extends ContentEntityInterface, RevisionLogInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Game Page Background name.
   *
   * @return string
   *   Name of the Game Page Background.
   */
  public function getName();

  /**
   * Sets the Game Page Background name.
   *
   * @param string $name
   *   The Game Page Background name.
   *
   * @return \Drupal\games_page_background\Entity\GamePageBackgroundInterface
   *   The called Game Page Background entity.
   */
  public function setName($name);

  /**
   * Gets the Game Page Background creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Game Page Background.
   */
  public function getCreatedTime();

  /**
   * Sets the Game Page Background creation timestamp.
   *
   * @param int $timestamp
   *   The Game Page Background creation timestamp.
   *
   * @return \Drupal\games_page_background\Entity\GamePageBackgroundInterface
   *   The called Game Page Background entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Game Page Background published status indicator.
   *
   * Unpublished Game Page Background are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Game Page Background is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Game Page Background.
   *
   * @param bool $published
   *   TRUE to set this Game Page Background to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\games_page_background\Entity\GamePageBackgroundInterface
   *   The called Game Page Background entity.
   */
  public function setPublished($published);

  /**
   * Gets the Game Page Background revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Game Page Background revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\games_page_background\Entity\GamePageBackgroundInterface
   *   The called Game Page Background entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Game Page Background revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Game Page Background revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\games_page_background\Entity\GamePageBackgroundInterface
   *   The called Game Page Background entity.
   */
  public function setRevisionUserId($uid);

}
