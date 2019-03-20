<?php

namespace Drupal\ghana_quick_links\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Quick links entity entities.
 *
 * @ingroup ghana_quick_links
 */
interface QuickLinksEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Quick links entity name.
   *
   * @return string
   *   Name of the Quick links entity.
   */
  public function getName();

  /**
   * Sets the Quick links entity name.
   *
   * @param string $name
   *   The Quick links entity name.
   *
   * @return \Drupal\ghana_quick_links\Entity\QuickLinksEntityInterface
   *   The called Quick links entity entity.
   */
  public function setName($name);

  /**
   * Gets the Quick links entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Quick links entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Quick links entity creation timestamp.
   *
   * @param int $timestamp
   *   The Quick links entity creation timestamp.
   *
   * @return \Drupal\ghana_quick_links\Entity\QuickLinksEntityInterface
   *   The called Quick links entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Quick links entity published status indicator.
   *
   * Unpublished Quick links entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Quick links entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Quick links entity.
   *
   * @param bool $published
   *   TRUE to set this Quick links entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\ghana_quick_links\Entity\QuickLinksEntityInterface
   *   The called Quick links entity entity.
   */
  public function setPublished($published);

}
