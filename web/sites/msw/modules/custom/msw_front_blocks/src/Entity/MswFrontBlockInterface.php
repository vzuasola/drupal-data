<?php

namespace Drupal\msw_front_blocks\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining msw front block entities.
 *
 * @ingroup msw_front_blocks
 */
interface MswFrontBlockInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the msw front block name.
   *
   * @return string
   *   Name of the msw front block.
   */
  public function getName();

  /**
   * Sets the msw front block name.
   *
   * @param string $name
   *   The msw front block name.
   *
   * @return \Drupal\msw_front_blocks\Entity\MswFrontBlockInterface
   *   The called msw front block entity.
   */
  public function setName($name);

  /**
   * Gets the msw front block creation timestamp.
   *
   * @return int
   *   Creation timestamp of the msw front block.
   */
  public function getCreatedTime();

  /**
   * Sets the msw front block creation timestamp.
   *
   * @param int $timestamp
   *   The msw front block creation timestamp.
   *
   * @return \Drupal\msw_front_blocks\Entity\MswFrontBlockInterface
   *   The called msw front block entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the msw front block published status indicator.
   *
   * Unpublished msw front block are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the msw front block is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a msw front block.
   *
   * @param bool $published
   *   TRUE to set this msw front block to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\msw_front_blocks\Entity\MswFrontBlockInterface
   *   The called msw front block entity.
   */
  public function setPublished($published);

}
