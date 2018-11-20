<?php

namespace Drupal\download_page\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Download page entity entities.
 *
 * @ingroup download_page
 */
interface DownloadPageEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Download page entity name.
   *
   * @return string
   *   Name of the Download page entity.
   */
  public function getName();

  /**
   * Sets the Download page entity name.
   *
   * @param string $name
   *   The Download page entity name.
   *
   * @return \Drupal\download_page\Entity\DownloadPageEntityInterface
   *   The called Download page entity entity.
   */
  public function setName($name);

  /**
   * Gets the Download page entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Download page entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Download page entity creation timestamp.
   *
   * @param int $timestamp
   *   The Download page entity creation timestamp.
   *
   * @return \Drupal\download_page\Entity\DownloadPageEntityInterface
   *   The called Download page entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Download page entity published status indicator.
   *
   * Unpublished Download page entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Download page entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Download page entity.
   *
   * @param bool $published
   *   TRUE to set this Download page entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\download_page\Entity\DownloadPageEntityInterface
   *   The called Download page entity entity.
   */
  public function setPublished($published);

}
