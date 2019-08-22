<?php

namespace Drupal\mobilehub\Entity;

use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\RevisionableInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Mobile tiles entities.
 *
 * @ingroup mobilehub
 */
interface MobileTilesInterface extends RevisionableInterface, RevisionLogInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Mobile tiles name.
   *
   * @return string
   *   Name of the Mobile tiles.
   */
  public function getName();

  /**
   * Sets the Mobile tiles name.
   *
   * @param string $name
   *   The Mobile tiles name.
   *
   * @return \Drupal\mobilehub\Entity\MobileTilesInterface
   *   The called Mobile tiles entity.
   */
  public function setName($name);

  /**
   * Gets the Mobile tiles creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Mobile tiles.
   */
  public function getCreatedTime();

  /**
   * Sets the Mobile tiles creation timestamp.
   *
   * @param int $timestamp
   *   The Mobile tiles creation timestamp.
   *
   * @return \Drupal\mobilehub\Entity\MobileTilesInterface
   *   The called Mobile tiles entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Mobile tiles published status indicator.
   *
   * Unpublished Mobile tiles are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Mobile tiles is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Mobile tiles.
   *
   * @param bool $published
   *   TRUE to set this Mobile tiles to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\mobilehub\Entity\MobileTilesInterface
   *   The called Mobile tiles entity.
   */
  public function setPublished($published);

  /**
   * Gets the Mobile tiles revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Mobile tiles revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\mobilehub\Entity\MobileTilesInterface
   *   The called Mobile tiles entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Mobile tiles revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Mobile tiles revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\mobilehub\Entity\MobileTilesInterface
   *   The called Mobile tiles entity.
   */
  public function setRevisionUserId($uid);

}
