<?php

namespace Drupal\webcomposer_floating_banners\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Left floating banner entity entities.
 *
 * @ingroup webcomposer_floating_banners
 */
interface LeftFloatingBannerEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Left floating banner entity name.
   *
   * @return string
   *   Name of the Left floating banner entity.
   */
  public function getName();

  /**
   * Sets the Left floating banner entity name.
   *
   * @param string $name
   *   The Left floating banner entity name.
   *
   * @return \Drupal\webcomposer_floating_banners\Entity\LeftFloatingBannerEntityInterface
   *   The called Left floating banner entity entity.
   */
  public function setName($name);

  /**
   * Gets the Left floating banner entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Left floating banner entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Left floating banner entity creation timestamp.
   *
   * @param int $timestamp
   *   The Left floating banner entity creation timestamp.
   *
   * @return \Drupal\webcomposer_floating_banners\Entity\LeftFloatingBannerEntityInterface
   *   The called Left floating banner entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Left floating banner entity published status indicator.
   *
   * Unpublished Left floating banner entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Left floating banner entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Left floating banner entity.
   *
   * @param bool $published
   *   TRUE to set this Left floating banner entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\webcomposer_floating_banners\Entity\LeftFloatingBannerEntityInterface
   *   The called Left floating banner entity entity.
   */
  public function setPublished($published);

}
