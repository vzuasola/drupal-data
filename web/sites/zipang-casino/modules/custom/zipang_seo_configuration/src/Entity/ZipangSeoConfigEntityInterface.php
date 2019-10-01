<?php

namespace Drupal\zipang_seo_configuration\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Zipang seo config entity entities.
 *
 * @ingroup zipang_seo_configuration
 */
interface ZipangSeoConfigEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Zipang seo config entity name.
   *
   * @return string
   *   Name of the Zipang seo config entity.
   */
  public function getName();

  /**
   * Sets the Zipang seo config entity name.
   *
   * @param string $name
   *   The Zipang seo config entity name.
   *
   * @return \Drupal\zipang_seo_configuration\Entity\ZipangSeoConfigEntityInterface
   *   The called Zipang seo config entity entity.
   */
  public function setName($name);

  /**
   * Gets the Zipang seo config entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Zipang seo config entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Zipang seo config entity creation timestamp.
   *
   * @param int $timestamp
   *   The Zipang seo config entity creation timestamp.
   *
   * @return \Drupal\zipang_seo_configuration\Entity\ZipangSeoConfigEntityInterface
   *   The called Zipang seo config entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Zipang seo config entity published status indicator.
   *
   * Unpublished Zipang seo config entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Zipang seo config entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Zipang seo config entity.
   *
   * @param bool $published
   *   TRUE to set this Zipang seo config entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\zipang_seo_configuration\Entity\ZipangSeoConfigEntityInterface
   *   The called Zipang seo config entity entity.
   */
  public function setPublished($published);

}
