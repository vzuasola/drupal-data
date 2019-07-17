<?php

namespace Drupal\zipang_gallery\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\Core\Entity\EntityPublishedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Zipang gallery entity entities.
 *
 * @ingroup zipang_gallery
 */
interface ZipangGalleryEntityInterface extends ContentEntityInterface, EntityChangedInterface, EntityPublishedInterface, EntityOwnerInterface {

  /**
   * Add get/set methods for your configuration properties here.
   */

  /**
   * Gets the Zipang gallery entity name.
   *
   * @return string
   *   Name of the Zipang gallery entity.
   */
  public function getName();

  /**
   * Sets the Zipang gallery entity name.
   *
   * @param string $name
   *   The Zipang gallery entity name.
   *
   * @return \Drupal\zipang_gallery\Entity\ZipangGalleryEntityInterface
   *   The called Zipang gallery entity entity.
   */
  public function setName($name);

  /**
   * Gets the Zipang gallery entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Zipang gallery entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Zipang gallery entity creation timestamp.
   *
   * @param int $timestamp
   *   The Zipang gallery entity creation timestamp.
   *
   * @return \Drupal\zipang_gallery\Entity\ZipangGalleryEntityInterface
   *   The called Zipang gallery entity entity.
   */
  public function setCreatedTime($timestamp);


}
