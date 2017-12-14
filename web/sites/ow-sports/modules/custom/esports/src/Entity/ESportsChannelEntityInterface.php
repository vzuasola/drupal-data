<?php

namespace Drupal\esports\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Esports channel entity entities.
 *
 * @ingroup esports
 */
interface ESportsChannelEntityInterface extends ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Esports channel entity name.
   *
   * @return string
   *   Name of the Esports channel entity.
   */
  public function getName();

  /**
   * Sets the Esports channel entity name.
   *
   * @param string $name
   *   The Esports channel entity name.
   *
   * @return \Drupal\esports\Entity\ESportsChannelEntityInterface
   *   The called Esports channel entity entity.
   */
  public function setName($name);

  /**
   * Gets the Esports channel entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Esports channel entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Esports channel entity creation timestamp.
   *
   * @param int $timestamp
   *   The Esports channel entity creation timestamp.
   *
   * @return \Drupal\esports\Entity\ESportsChannelEntityInterface
   *   The called Esports channel entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Esports channel entity published status indicator.
   *
   * Unpublished Esports channel entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Esports channel entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Esports channel entity.
   *
   * @param bool $published
   *   TRUE to set this Esports channel entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\esports\Entity\ESportsChannelEntityInterface
   *   The called Esports channel entity entity.
   */
  public function setPublished($published);

}
