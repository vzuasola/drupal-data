<?php

namespace Drupal\webcomposer_mobile_menu\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Mobile menu entity entities.
 *
 * @ingroup webcomposer_mobile_menu
 */
interface MobileMenuEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Mobile menu entity name.
   *
   * @return string
   *   Name of the Mobile menu entity.
   */
  public function getName();

  /**
   * Sets the Mobile menu entity name.
   *
   * @param string $name
   *   The Mobile menu entity name.
   *
   * @return \Drupal\webcomposer_mobile_menu\Entity\MobileMenuEntityInterface
   *   The called Mobile menu entity entity.
   */
  public function setName($name);

  /**
   * Gets the Mobile menu entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Mobile menu entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Mobile menu entity creation timestamp.
   *
   * @param int $timestamp
   *   The Mobile menu entity creation timestamp.
   *
   * @return \Drupal\webcomposer_mobile_menu\Entity\MobileMenuEntityInterface
   *   The called Mobile menu entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Mobile menu entity published status indicator.
   *
   * Unpublished Mobile menu entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Mobile menu entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Mobile menu entity.
   *
   * @param bool $published
   *   TRUE to set this Mobile menu entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\webcomposer_mobile_menu\Entity\MobileMenuEntityInterface
   *   The called Mobile menu entity entity.
   */
  public function setPublished($published);

}
