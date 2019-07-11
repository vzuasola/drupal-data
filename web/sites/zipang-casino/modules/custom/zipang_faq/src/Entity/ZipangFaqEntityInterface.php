<?php

namespace Drupal\zipang_faq\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Zipang faq entity entities.
 *
 * @ingroup zipang_faq
 */
interface ZipangFaqEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Zipang faq entity name.
   *
   * @return string
   *   Name of the Zipang faq entity.
   */
  public function getName();

  /**
   * Sets the Zipang faq entity name.
   *
   * @param string $name
   *   The Zipang faq entity name.
   *
   * @return \Drupal\zipang_faq\Entity\ZipangFaqEntityInterface
   *   The called Zipang faq entity entity.
   */
  public function setName($name);

  /**
   * Gets the Zipang faq entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Zipang faq entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Zipang faq entity creation timestamp.
   *
   * @param int $timestamp
   *   The Zipang faq entity creation timestamp.
   *
   * @return \Drupal\zipang_faq\Entity\ZipangFaqEntityInterface
   *   The called Zipang faq entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Zipang faq entity published status indicator.
   *
   * Unpublished Zipang faq entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Zipang faq entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Zipang faq entity.
   *
   * @param bool $published
   *   TRUE to set this Zipang faq entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\zipang_faq\Entity\ZipangFaqEntityInterface
   *   The called Zipang faq entity entity.
   */
  public function setPublished($published);

}
