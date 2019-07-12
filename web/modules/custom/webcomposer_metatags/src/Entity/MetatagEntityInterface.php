<?php

namespace Drupal\webcomposer_metatags\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Metatag entity entities.
 *
 * @ingroup webcomposer_metatags
 */
interface MetatagEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Metatag entity name.
   *
   * @return string
   *   Name of the Metatag entity.
   */
  public function getName();

  /**
   * Sets the Metatag entity name.
   *
   * @param string $name
   *   The Metatag entity name.
   *
   * @return \Drupal\webcomposer_metatags\Entity\MetatagEntityInterface
   *   The called Metatag entity entity.
   */
  public function setName($name);

  /**
   * Gets the Metatag entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Metatag entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Metatag entity creation timestamp.
   *
   * @param int $timestamp
   *   The Metatag entity creation timestamp.
   *
   * @return \Drupal\webcomposer_metatags\Entity\MetatagEntityInterface
   *   The called Metatag entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Metatag entity published status indicator.
   *
   * Unpublished Metatag entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Metatag entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Metatag entity.
   *
   * @param bool $published
   *   TRUE to set this Metatag entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\webcomposer_metatags\Entity\MetatagEntityInterface
   *   The called Metatag entity entity.
   */
  public function setPublished($published);

}
