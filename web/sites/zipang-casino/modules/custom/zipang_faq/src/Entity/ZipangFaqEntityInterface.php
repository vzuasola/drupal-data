<?php

namespace Drupal\zipang_faq\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Zipang FAQ Entity entities.
 *
 * @ingroup zipang_faq
 */
interface ZipangFaqEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Zipang FAQ Entity name.
   *
   * @return string
   *   Name of the Zipang FAQ Entity.
   */
  public function getName();

  /**
   * Sets the Zipang FAQ Entity name.
   *
   * @param string $name
   *   The Zipang FAQ Entity name.
   *
   * @return \Drupal\zipang_faq\Entity\ZipangFaqEntityInterface
   *   The called Zipang FAQ Entity entity.
   */
  public function setName($name);

  /**
   * Gets the Zipang FAQ Entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Zipang FAQ Entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Zipang FAQ Entity creation timestamp.
   *
   * @param int $timestamp
   *   The Zipang FAQ Entity creation timestamp.
   *
   * @return \Drupal\zipang_faq\Entity\ZipangFaqEntityInterface
   *   The called Zipang FAQ Entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Zipang FAQ Entity published status indicator.
   *
   * Unpublished Zipang FAQ Entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Zipang FAQ Entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Zipang FAQ Entity.
   *
   * @param bool $published
   *   TRUE to set this Zipang FAQ Entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\zipang_faq\Entity\ZipangFaqEntityInterface
   *   The called Zipang FAQ Entity entity.
   */
  public function setPublished($published);

}
