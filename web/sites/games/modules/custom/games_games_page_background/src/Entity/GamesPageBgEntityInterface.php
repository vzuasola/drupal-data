<?php

namespace Drupal\casino_games_page_background\Entity;

use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\RevisionableInterface;
use Drupal\Component\Utility\Xss;
use Drupal\Core\Url;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Casino Games Page Background entities.
 *
 * @ingroup casino_games_page_background
 */
interface GamesPageBgEntityInterface extends RevisionableInterface, RevisionLogInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Casino Games Page Background name.
   *
   * @return string
   *   Name of the Casino Games Page Background.
   */
  public function getName();

  /**
   * Sets the Casino Games Page Background name.
   *
   * @param string $name
   *   The Casino Games Page Background name.
   *
   * @return \Drupal\casino_games_page_background\Entity\GamesPageBgEntityInterface
   *   The called Casino Games Page Background entity.
   */
  public function setName($name);

  /**
   * Gets the Casino Games Page Background creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Casino Games Page Background.
   */
  public function getCreatedTime();

  /**
   * Sets the Casino Games Page Background creation timestamp.
   *
   * @param int $timestamp
   *   The Casino Games Page Background creation timestamp.
   *
   * @return \Drupal\casino_games_page_background\Entity\GamesPageBgEntityInterface
   *   The called Casino Games Page Background entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Casino Games Page Background published status indicator.
   *
   * Unpublished Casino Games Page Background are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Casino Games Page Background is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Casino Games Page Background.
   *
   * @param bool $published
   *   TRUE to set this Casino Games Page Background to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\casino_games_page_background\Entity\GamesPageBgEntityInterface
   *   The called Casino Games Page Background entity.
   */
  public function setPublished($published);

  /**
   * Gets the Casino Games Page Background revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Casino Games Page Background revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\casino_games_page_background\Entity\GamesPageBgEntityInterface
   *   The called Casino Games Page Background entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Casino Games Page Background revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Casino Games Page Background revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\casino_games_page_background\Entity\GamesPageBgEntityInterface
   *   The called Casino Games Page Background entity.
   */
  public function setRevisionUserId($uid);

}
