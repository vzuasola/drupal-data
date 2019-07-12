<?php

namespace Drupal\mobile_sponsor_list\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Mobile sponsor list entities.
 *
 * @ingroup mobile_sponsor_list
 */
interface MobileSponsorListInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Mobile sponsor list name.
   *
   * @return string
   *   Name of the Mobile sponsor list.
   */
  public function getName();

  /**
   * Sets the Mobile sponsor list name.
   *
   * @param string $name
   *   The Mobile sponsor list name.
   *
   * @return \Drupal\mobile_sponsor_list\Entity\MobileSponsorListInterface
   *   The called Mobile sponsor list entity.
   */
  public function setName($name);

  /**
   * Gets the Mobile sponsor list creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Mobile sponsor list.
   */
  public function getCreatedTime();

  /**
   * Sets the Mobile sponsor list creation timestamp.
   *
   * @param int $timestamp
   *   The Mobile sponsor list creation timestamp.
   *
   * @return \Drupal\mobile_sponsor_list\Entity\MobileSponsorListInterface
   *   The called Mobile sponsor list entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Mobile sponsor list published status indicator.
   *
   * Unpublished Mobile sponsor list are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Mobile sponsor list is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Mobile sponsor list.
   *
   * @param bool $published
   *   TRUE to set this Mobile sponsor list to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\mobile_sponsor_list\Entity\MobileSponsorListInterface
   *   The called Mobile sponsor list entity.
   */
  public function setPublished($published);

}
