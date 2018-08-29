<?php

namespace Drupal\jamboree_404\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Jamboree 404 Image Entity entities.
 *
 * @ingroup jamboree_404
 */
interface Jamboree404ImageEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Jamboree 404 Image Entity name.
   *
   * @return string
   *   Name of the Jamboree 404 Image Entity.
   */
  public function getName();

  /**
   * Sets the Jamboree 404 Image Entity name.
   *
   * @param string $name
   *   The Jamboree 404 Image Entity name.
   *
   * @return \Drupal\jamboree_404\Entity\Jamboree404ImageEntityInterface
   *   The called Jamboree 404 Image Entity entity.
   */
  public function setName($name);

  /**
   * Gets the Jamboree 404 Image Entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Jamboree 404 Image Entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Jamboree 404 Image Entity creation timestamp.
   *
   * @param int $timestamp
   *   The Jamboree 404 Image Entity creation timestamp.
   *
   * @return \Drupal\jamboree_404\Entity\Jamboree404ImageEntityInterface
   *   The called Jamboree 404 Image Entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Jamboree 404 Image Entity published status indicator.
   *
   * Unpublished Jamboree 404 Image Entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Jamboree 404 Image Entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Jamboree 404 Image Entity.
   *
   * @param bool $published
   *   TRUE to set this Jamboree 404 Image Entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\jamboree_404\Entity\Jamboree404ImageEntityInterface
   *   The called Jamboree 404 Image Entity entity.
   */
  public function setPublished($published);

}
