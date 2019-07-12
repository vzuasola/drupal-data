<?php

namespace Drupal\custom_inner_pages\Entity;

use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\RevisionableInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining How to play entities.
 *
 * @ingroup custom_inner_pages
 */
interface HowToPlayInterface extends RevisionableInterface, RevisionLogInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the How to play name.
   *
   * @return string
   *   Name of the How to play.
   */
  public function getName();

  /**
   * Sets the How to play name.
   *
   * @param string $name
   *   The How to play name.
   *
   * @return \Drupal\custom_inner_pages\Entity\HowToPlayInterface
   *   The called How to play entity.
   */
  public function setName($name);

  /**
   * Gets the How to play creation timestamp.
   *
   * @return int
   *   Creation timestamp of the How to play.
   */
  public function getCreatedTime();

  /**
   * Sets the How to play creation timestamp.
   *
   * @param int $timestamp
   *   The How to play creation timestamp.
   *
   * @return \Drupal\custom_inner_pages\Entity\HowToPlayInterface
   *   The called How to play entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the How to play published status indicator.
   *
   * Unpublished How to play are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the How to play is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a How to play.
   *
   * @param bool $published
   *   TRUE to set this How to play to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\custom_inner_pages\Entity\HowToPlayInterface
   *   The called How to play entity.
   */
  public function setPublished($published);

  /**
   * Gets the How to play revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the How to play revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\custom_inner_pages\Entity\HowToPlayInterface
   *   The called How to play entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the How to play revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the How to play revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\custom_inner_pages\Entity\HowToPlayInterface
   *   The called How to play entity.
   */
  public function setRevisionUserId($uid);

}
