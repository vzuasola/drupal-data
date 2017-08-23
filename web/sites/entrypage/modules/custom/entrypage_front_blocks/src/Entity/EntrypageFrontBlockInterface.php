<?php

namespace Drupal\entrypage_front_blocks\Entity;

use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\Core\Entity\RevisionableInterface;
use Drupal\Component\Utility\Xss;
use Drupal\Core\Url;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Entrypage front block entities.
 *
 * @ingroup entrypage_front_blocks
 */
interface EntrypageFrontBlockInterface extends RevisionableInterface, RevisionLogInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Entrypage front block name.
   *
   * @return string
   *   Name of the Entrypage front block.
   */
  public function getName();

  /**
   * Sets the Entrypage front block name.
   *
   * @param string $name
   *   The Entrypage front block name.
   *
   * @return \Drupal\entrypage_front_blocks\Entity\EntrypageFrontBlockInterface
   *   The called Entrypage front block entity.
   */
  public function setName($name);

  /**
   * Gets the Entrypage front block creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Entrypage front block.
   */
  public function getCreatedTime();

  /**
   * Sets the Entrypage front block creation timestamp.
   *
   * @param int $timestamp
   *   The Entrypage front block creation timestamp.
   *
   * @return \Drupal\entrypage_front_blocks\Entity\EntrypageFrontBlockInterface
   *   The called Entrypage front block entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Entrypage front block published status indicator.
   *
   * Unpublished Entrypage front block are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Entrypage front block is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Entrypage front block.
   *
   * @param bool $published
   *   TRUE to set this Entrypage front block to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\entrypage_front_blocks\Entity\EntrypageFrontBlockInterface
   *   The called Entrypage front block entity.
   */
  public function setPublished($published);

  /**
   * Gets the Entrypage front block revision creation timestamp.
   *
   * @return int
   *   The UNIX timestamp of when this revision was created.
   */
  public function getRevisionCreationTime();

  /**
   * Sets the Entrypage front block revision creation timestamp.
   *
   * @param int $timestamp
   *   The UNIX timestamp of when this revision was created.
   *
   * @return \Drupal\entrypage_front_blocks\Entity\EntrypageFrontBlockInterface
   *   The called Entrypage front block entity.
   */
  public function setRevisionCreationTime($timestamp);

  /**
   * Gets the Entrypage front block revision author.
   *
   * @return \Drupal\user\UserInterface
   *   The user entity for the revision author.
   */
  public function getRevisionUser();

  /**
   * Sets the Entrypage front block revision author.
   *
   * @param int $uid
   *   The user ID of the revision author.
   *
   * @return \Drupal\entrypage_front_blocks\Entity\EntrypageFrontBlockInterface
   *   The called Entrypage front block entity.
   */
  public function setRevisionUserId($uid);

}
