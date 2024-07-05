<?php

namespace Drupal\zipang_new_slider\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Zipang new slider entity entities.
 *
 * @ingroup zipang_new_slider
 */
interface ZipangNewSliderEntityInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {
  
  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Zipang new slider entity name.
   *
   * @return string
   *   Name of the Zipang new slider entity.
   */
  public function getName();

  /**
   * Sets the Zipang new slider entity name.
   *
   * @param string $name
   *   The Zipang new slider entity name.
   *
   * @return \Drupal\zipang_new_slider\Entity\ZipangNewSliderEntityInterface
   *   The called Zipang new slider entity.
   */
  public function setName($name);

  /**
   * Gets the Zipang new slider entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Zipang new slider entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Zipang new slider entity creation timestamp.
   *
   * @param int $timestamp
   *   The Zipang new slider entity creation timestamp.
   *
   * @return \Drupal\zipang_new_slider\Entity\ZipangNewSliderEntityInterface
   *   The calledZipang new slider entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Zipang new slider entity published status indicator.
   *
   * Unpublished Zipang new slider entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Zipang new slider entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Zipang new slider entity.
   *
   * @param bool $published
   *   TRUE to set this Zipang new slider entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\zipang_new_slider\Entity\ZipangNewSliderEntityInterface
   *   The called Zipang new slider entity.
   */
  public function setPublished($published);
}
