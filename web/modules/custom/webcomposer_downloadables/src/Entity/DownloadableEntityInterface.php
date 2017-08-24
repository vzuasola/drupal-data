<?php

namespace Drupal\webcomposer_downloadables\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Downloadable entity entities.
 *
 * @ingroup webcomposer_downloadables
 */
interface DownloadableEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Downloadable entity name.
   *
   * @return string
   *   Name of the Downloadable entity.
   */
  public function getName();

  /**
   * Sets the Downloadable entity name.
   *
   * @param string $name
   *   The Downloadable entity name.
   *
   * @return \Drupal\webcomposer_downloadables\Entity\DownloadableEntityInterface
   *   The called Downloadable entity entity.
   */
  public function setName($name);

  /**
   * Gets the Downloadable entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Downloadable entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Downloadable entity creation timestamp.
   *
   * @param int $timestamp
   *   The Downloadable entity creation timestamp.
   *
   * @return \Drupal\webcomposer_downloadables\Entity\DownloadableEntityInterface
   *   The called Downloadable entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Downloadable entity published status indicator.
   *
   * Unpublished Downloadable entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Downloadable entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Downloadable entity.
   *
   * @param bool $published
   *   TRUE to set this Downloadable entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\webcomposer_downloadables\Entity\DownloadableEntityInterface
   *   The called Downloadable entity entity.
   */
  public function setPublished($published);

}
