<?php

namespace Drupal\zipang_404\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Zipang 404 Image Entity entities.
 *
 * @ingroup zipang_404
 */
interface Zipang404ImageEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Zipang 404 Image Entity name.
   *
   * @return string
   *   Name of the Zipang 404 Image Entity.
   */
  public function getName();

  /**
   * Sets the Zipang 404 Image Entity name.
   *
   * @param string $name
   *   The Zipang 404 Image Entity name.
   *
   * @return \Drupal\zipang_404\Entity\Zipang404ImageEntityInterface
   *   The called Zipang 404 Image Entity entity.
   */
  public function setName($name);

  /**
   * Gets the Zipang 404 Image Entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Zipang 404 Image Entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Zipang 404 Image Entity creation timestamp.
   *
   * @param int $timestamp
   *   The Zipang 404 Image Entity creation timestamp.
   *
   * @return \Drupal\zipang_404\Entity\Zipang404ImageEntityInterface
   *   The called Zipang 404 Image Entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Zipang 404 Image Entity published status indicator.
   *
   * Unpublished Zipang 404 Image Entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Zipang 404 Image Entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Zipang 404 Image Entity.
   *
   * @param bool $published
   *   TRUE to set this Zipang 404 Image Entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\zipang_404\Entity\Zipang404ImageEntityInterface
   *   The called Zipang 404 Image Entity entity.
   */
  public function setPublished($published);

}
