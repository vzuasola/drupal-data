<?php

namespace Drupal\mobile_product_menu\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Mobile Product Menu entities.
 *
 * @ingroup mobile_product_menu
 */
interface MobileProductMenuInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Mobile Product Menu name.
   *
   * @return string
   *   Name of the Mobile Product Menu.
   */
  public function getName();

  /**
   * Sets the Mobile Product Menu name.
   *
   * @param string $name
   *   The Mobile Product Menu name.
   *
   * @return \Drupal\mobile_product_menu\Entity\MobileProductMenuInterface
   *   The called Mobile Product Menu entity.
   */
  public function setName($name);

  /**
   * Gets the Mobile Product Menu creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Mobile Product Menu.
   */
  public function getCreatedTime();

  /**
   * Sets the Mobile Product Menu creation timestamp.
   *
   * @param int $timestamp
   *   The Mobile Product Menu creation timestamp.
   *
   * @return \Drupal\mobile_product_menu\Entity\MobileProductMenuInterface
   *   The called Mobile Product Menu entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Mobile Product Menu published status indicator.
   *
   * Unpublished Mobile Product Menu are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Mobile Product Menu is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Mobile Product Menu.
   *
   * @param bool $published
   *   TRUE to set this Mobile Product Menu to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\mobile_product_menu\Entity\MobileProductMenuInterface
   *   The called Mobile Product Menu entity.
   */
  public function setPublished($published);

}
