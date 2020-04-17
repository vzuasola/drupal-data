<?php

namespace Drupal\mobile_sponsor_list_v2\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Mobile Sponsor List version 2.0 entities.
 *
 * @ingroup mobile_sponsor_list_v2
 */
interface MobileSponsorListv2Interface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Mobile Sponsor List version 2.0 name.
   *
   * @return string
   *   Name of the Mobile Sponsor List version 2.0.
   */
  public function getName();

  /**
   * Sets the Mobile Sponsor List version 2.0 name.
   *
   * @param string $name
   *   The Mobile Sponsor List version 2.0 name.
   *
   * @return \Drupal\mobile_sponsor_list_v2\Entity\MobileSponsorListv2Interface
   *   The called Mobile Sponsor List version 2.0 entity.
   */
  public function setName($name);

  /**
   * Gets the Mobile Sponsor List version 2.0 creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Mobile Sponsor List version 2.0.
   */
  public function getCreatedTime();

  /**
   * Sets the Mobile Sponsor List version 2.0 creation timestamp.
   *
   * @param int $timestamp
   *   The Mobile Sponsor List version 2.0 creation timestamp.
   *
   * @return \Drupal\mobile_sponsor_list_v2\Entity\MobileSponsorListv2Interface
   *   The called Mobile Sponsor List version 2.0 entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Mobile Sponsor List version 2.0 published status indicator.
   *
   * Unpublished Mobile Sponsor List version 2.0 are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Mobile Sponsor List version 2.0 is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Mobile Sponsor List version 2.0.
   *
   * @param bool $published
   *   TRUE to set this Mobile Sponsor List version 2.0 to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\mobile_sponsor_list_v2\Entity\MobileSponsorListv2Interface
   *   The called Mobile Sponsor List version 2.0 entity.
   */
  public function setPublished($published);

}
