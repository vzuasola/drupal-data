<?php

namespace Drupal\entrypage_front_blocks\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Entrypage front block entities.
 *
 * @ingroup entrypage_front_blocks
 */
interface EntrypageFrontBlockInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Entrypage front block name.
   *
   * @return string
   *   Name of the Entrypage front block.
   */
  public function getName();

  /**
   * Sets the Entrypage front block name.
   *
   * @param string $name
   *   The Entrypage front block name.
   *
   * @return \Drupal\entrypage_front_blocks\Entity\EntrypageFrontBlockInterface
   *   The called Entrypage front block entity.
   */
  public function setName($name);

  /**
   * Gets the Entrypage front block creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Entrypage front block.
   */
  public function getCreatedTime();

  /**
   * Sets the Entrypage front block creation timestamp.
   *
   * @param int $timestamp
   *   The Entrypage front block creation timestamp.
   *
   * @return \Drupal\entrypage_front_blocks\Entity\EntrypageFrontBlockInterface
   *   The called Entrypage front block entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Entrypage front block published status indicator.
   *
   * Unpublished Entrypage front block are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Entrypage front block is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Entrypage front block.
   *
   * @param bool $published
   *   TRUE to set this Entrypage front block to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\entrypage_front_blocks\Entity\EntrypageFrontBlockInterface
   *   The called Entrypage front block entity.
   */
  public function setPublished($published);

}
