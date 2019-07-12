<?php

namespace Drupal\webcomposer_partner\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Partner entity entities.
 *
 * @ingroup webcomposer_partner
 */
interface PartnerEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Partner entity name.
   *
   * @return string
   *   Name of the Partner entity.
   */
  public function getName();

  /**
   * Sets the Partner entity name.
   *
   * @param string $name
   *   The Partner entity name.
   *
   * @return \Drupal\webcomposer_partner\Entity\PartnerEntityInterface
   *   The called Partner entity entity.
   */
  public function setName($name);

  /**
   * Gets the Partner entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Partner entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Partner entity creation timestamp.
   *
   * @param int $timestamp
   *   The Partner entity creation timestamp.
   *
   * @return \Drupal\webcomposer_partner\Entity\PartnerEntityInterface
   *   The called Partner entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Partner entity published status indicator.
   *
   * Unpublished Partner entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Partner entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Partner entity.
   *
   * @param bool $published
   *   TRUE to set this Partner entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\webcomposer_partner\Entity\PartnerEntityInterface
   *   The called Partner entity entity.
   */
  public function setPublished($published);

}
