<?php

namespace Drupal\msw_prioritization_menu\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Video Call Prioritization Menu entities.
 *
 * @ingroup msw_prioritization_menu
 */
interface MswPrioritizationMenuInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Video Call Prioritization Menu name.
   *
   * @return string
   *   Name of the Video Call Prioritization Menu.
   */
  public function getName();

  /**
   * Sets the Video Call Prioritization Menu name.
   *
   * @param string $name
   *   The Video Call Prioritization Menu name.
   *
   * @return \Drupal\msw_prioritization_menu\Entity\MswPrioritizationMenuInterface
   *   The called Video Call Prioritization Menu entity.
   */
  public function setName($name);

  /**
   * Gets the Video Call Prioritization Menu creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Video Call Prioritization Menu.
   */
  public function getCreatedTime();

  /**
   * Sets the Video Call Prioritization Menu creation timestamp.
   *
   * @param int $timestamp
   *   The Video Call Prioritization Menu creation timestamp.
   *
   * @return \Drupal\msw_prioritization_menu\Entity\MswPrioritizationMenuInterface
   *   The called Video Call Prioritization Menu entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Video Call Prioritization Menu published status indicator.
   *
   * Unpublished Video Call Prioritization Menu are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Video Call Prioritization Menu is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Video Call Prioritization Menu.
   *
   * @param bool $published
   *   TRUE to set this Video Call Prioritization Menu to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\msw_prioritization_menu\Entity\MswPrioritizationMenuInterface
   *   The called Video Call Prioritization Menu entity.
   */
  public function setPublished($published);

}
