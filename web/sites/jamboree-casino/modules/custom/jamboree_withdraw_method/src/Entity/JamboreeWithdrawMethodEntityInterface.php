<?php

namespace Drupal\jamboree_withdraw_method\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Jamboree withdraw method entity entities.
 *
 * @ingroup jamboree_withdraw_method
 */
interface JamboreeWithdrawMethodEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Jamboree withdraw method entity name.
   *
   * @return string
   *   Name of the Jamboree withdraw method entity.
   */
  public function getName();

  /**
   * Sets the Jamboree withdraw method entity name.
   *
   * @param string $name
   *   The Jamboree withdraw method entity name.
   *
   * @return \Drupal\jamboree_withdraw_method\Entity\JamboreeWithdrawMethodEntityInterface
   *   The called Jamboree withdraw method entity entity.
   */
  public function setName($name);

  /**
   * Gets the Jamboree withdraw method entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Jamboree withdraw method entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Jamboree withdraw method entity creation timestamp.
   *
   * @param int $timestamp
   *   The Jamboree withdraw method entity creation timestamp.
   *
   * @return \Drupal\jamboree_withdraw_method\Entity\JamboreeWithdrawMethodEntityInterface
   *   The called Jamboree withdraw method entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Jamboree withdraw method entity published status indicator.
   *
   * Unpublished Jamboree withdraw method entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Jamboree withdraw method entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Jamboree withdraw method entity.
   *
   * @param bool $published
   *   TRUE to set this Jamboree withdraw method entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\jamboree_withdraw_method\Entity\JamboreeWithdrawMethodEntityInterface
   *   The called Jamboree withdraw method entity entity.
   */
  public function setPublished($published);

}
