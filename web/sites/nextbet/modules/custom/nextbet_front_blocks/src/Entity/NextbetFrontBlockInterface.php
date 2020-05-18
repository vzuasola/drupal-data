<?php

namespace Drupal\nextbet_front_blocks\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Nextbet front block entities.
 *
 * @ingroup nextbet_front_blocks
 */
interface NextbetFrontBlockInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Nextbet front block name.
   *
   * @return string
   *   Name of the Nextbet front block.
   */
  public function getName();

  /**
   * Sets the Nextbet front block name.
   *
   * @param string $name
   *   The Nextbet front block name.
   *
   * @return \Drupal\nextbet_front_blocks\Entity\NextbetFrontBlockInterface
   *   The called Nextbet front block entity.
   */
  public function setName($name);

  /**
   * Gets the Nextbet front block creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Nextbet front block.
   */
  public function getCreatedTime();

  /**
   * Sets the Nextbet front block creation timestamp.
   *
   * @param int $timestamp
   *   The Nextbet front block creation timestamp.
   *
   * @return \Drupal\nextbet_front_blocks\Entity\NextbetFrontBlockInterface
   *   The called Nextbet front block entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Nextbet front block published status indicator.
   *
   * Unpublished Nextbet front block are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Nextbet front block is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Nextbet front block.
   *
   * @param bool $published
   *   TRUE to set this Nextbet front block to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\nextbet_front_blocks\Entity\NextbetFrontBlockInterface
   *   The called Nextbet front block entity.
   */
  public function setPublished($published);

}
