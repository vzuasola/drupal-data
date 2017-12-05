<?php

namespace Drupal\games_page_background\Entity;

use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\RevisionableInterface;
use Drupal\Component\Utility\Xss;
use Drupal\Core\Url;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Games Page Background entities.
 *
 * @ingroup games_page_background
 */
interface GamesPageBgEntityInterface extends RevisionableInterface, RevisionLogInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Games Page Background name.
   *
   * @return string
   *   Name of the Games Page Background.
   */
  public function getName();

  /**
   * Sets the Games Page Background name.
   *
   * @param string $name
   *   The Games Page Background name.
   *
   * @return \Drupal\games_page_background\Entity\GamesPageBgEntityInterface
   *   The called Games Page Background entity.
   */
  public function setName($name);

  /**
   * Gets the Games Page Background creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Games Page Background.
   */
  public function getCreatedTime();

  /**
   * Sets the Games Page Background creation timestamp.
   *
   * @param int $timestamp
   *   The Games Page Background creation timestamp.
   *
   * @return \Drupal\games_page_background\Entity\GamesPageBgEntityInterface
   *   The called Games Page Background entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Games Page Background published status indicator.
   *
   * Unpublished Games Page Background are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Games Page Background is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Games Page Background.
   *
   * @param bool $published
   *   TRUE to set this Games Page Background to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\games_page_background\Entity\GamesPageBgEntityInterface
   *   The called Games Page Background entity.
   */
  public function setPublished($published);

  /**
   * Gets the Games Page Background revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Games Page Background revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\games_page_background\Entity\GamesPageBgEntityInterface
   *   The called Games Page Background entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Games Page Background revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Games Page Background revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\games_page_background\Entity\GamesPageBgEntityInterface
   *   The called Games Page Background entity.
   */
  public function setRevisionUserId($uid);

}
