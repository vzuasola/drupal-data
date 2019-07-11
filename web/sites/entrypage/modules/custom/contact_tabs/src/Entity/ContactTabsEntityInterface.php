<?php

namespace Drupal\contact_tabs\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Contact tabs entity entities.
 *
 * @ingroup contact_tabs
 */
interface ContactTabsEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Contact tabs entity name.
   *
   * @return string
   *   Name of the Contact tabs entity.
   */
  public function getName();

  /**
   * Sets the Contact tabs entity name.
   *
   * @param string $name
   *   The Contact tabs entity name.
   *
   * @return \Drupal\contact_tabs\Entity\ContactTabsEntityInterface
   *   The called Contact tabs entity entity.
   */
  public function setName($name);

  /**
   * Gets the Contact tabs entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Contact tabs entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Contact tabs entity creation timestamp.
   *
   * @param int $timestamp
   *   The Contact tabs entity creation timestamp.
   *
   * @return \Drupal\contact_tabs\Entity\ContactTabsEntityInterface
   *   The called Contact tabs entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Contact tabs entity published status indicator.
   *
   * Unpublished Contact tabs entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Contact tabs entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Contact tabs entity.
   *
   * @param bool $published
   *   TRUE to set this Contact tabs entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\contact_tabs\Entity\ContactTabsEntityInterface
   *   The called Contact tabs entity entity.
   */
  public function setPublished($published);

}
