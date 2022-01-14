<?php

namespace Drupal\zedbet_front_blocks\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Zedbet front block entities.
 *
 * @ingroup zedbet_front_blocks
 */
interface ZedbetFrontBlockInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Zedbet front block name.
   *
   * @return string
   *   Name of the Zedbet front block.
   */
  public function getName();

  /**
   * Sets the Zedbet front block name.
   *
   * @param string $name
   *   The Zedbet front block name.
   *
   * @return \Drupal\zedbet_front_blocks\Entity\ZedbetFrontBlockInterface
   *   The called Zedbet front block entity.
   */
  public function setName($name);

  /**
   * Gets the Zedbet front block creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Zedbet front block.
   */
  public function getCreatedTime();

  /**
   * Sets the Zedbet front block creation timestamp.
   *
   * @param int $timestamp
   *   The Zedbet front block creation timestamp.
   *
   * @return \Drupal\zedbet_front_blocks\Entity\ZedbetFrontBlockInterface
   *   The called Zedbet front block entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Zedbet front block published status indicator.
   *
   * Unpublished Zedbet front block are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Zedbet front block is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Zedbet front block.
   *
   * @param bool $published
   *   TRUE to set this Zedbet front block to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\zedbet_front_blocks\Entity\ZedbetFrontBlockInterface
   *   The called Zedbet front block entity.
   */
  public function setPublished($published);

}
