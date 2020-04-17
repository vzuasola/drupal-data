<?php

namespace Drupal\mobile_infobar\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Mobile info bar entities.
 *
 * @ingroup mobile_infobar
 */
interface MobileInfoBarInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Mobile info bar name.
   *
   * @return string
   *   Name of the Mobile info bar.
   */
  public function getName();

  /**
   * Sets the Mobile info bar name.
   *
   * @param string $name
   *   The Mobile info bar name.
   *
   * @return \Drupal\mobile_infobar\Entity\MobileInfoBarInterface
   *   The called Mobile info bar entity.
   */
  public function setName($name);

  /**
   * Gets the Mobile info bar creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Mobile info bar.
   */
  public function getCreatedTime();

  /**
   * Sets the Mobile info bar creation timestamp.
   *
   * @param int $timestamp
   *   The Mobile info bar creation timestamp.
   *
   * @return \Drupal\mobile_infobar\Entity\MobileInfoBarInterface
   *   The called Mobile info bar entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Mobile info bar published status indicator.
   *
   * Unpublished Mobile info bar are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Mobile info bar is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Mobile info bar.
   *
   * @param bool $published
   *   TRUE to set this Mobile info bar to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\mobile_infobar\Entity\MobileInfoBarInterface
   *   The called Mobile info bar entity.
   */
  public function setPublished($published);

}
