<?php

namespace Drupal\jamboree_faq\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Jamboree FAQ Entity entities.
 *
 * @ingroup jamboree_faq
 */
interface JamboreeFAQEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Jamboree FAQ Entity name.
   *
   * @return string
   *   Name of the Jamboree FAQ Entity.
   */
  public function getName();

  /**
   * Sets the Jamboree FAQ Entity name.
   *
   * @param string $name
   *   The Jamboree FAQ Entity name.
   *
   * @return \Drupal\jamboree_faq\Entity\JamboreeFAQEntityInterface
   *   The called Jamboree FAQ Entity entity.
   */
  public function setName($name);

  /**
   * Gets the Jamboree FAQ Entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Jamboree FAQ Entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Jamboree FAQ Entity creation timestamp.
   *
   * @param int $timestamp
   *   The Jamboree FAQ Entity creation timestamp.
   *
   * @return \Drupal\jamboree_faq\Entity\JamboreeFAQEntityInterface
   *   The called Jamboree FAQ Entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Jamboree FAQ Entity published status indicator.
   *
   * Unpublished Jamboree FAQ Entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Jamboree FAQ Entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Jamboree FAQ Entity.
   *
   * @param bool $published
   *   TRUE to set this Jamboree FAQ Entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\jamboree_faq\Entity\JamboreeFAQEntityInterface
   *   The called Jamboree FAQ Entity entity.
   */
  public function setPublished($published);

}
