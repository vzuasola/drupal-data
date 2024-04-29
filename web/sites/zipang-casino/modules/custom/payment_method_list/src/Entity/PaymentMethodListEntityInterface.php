<?php

namespace Drupal\payment_method_list\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Payment Method entity entities.
 *
 * @ingroup payment_method_list
 */
interface PaymentMethodListEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Payment Method entity name.
   *
   * @return string
   *   Name of the Payment Method entity.
   */
  public function getName();

  /**
   * Sets the Payment Method entity name.
   *
   * @param string $name
   *   The Payment Method entity name.
   *
   * @return \Drupal\payment_method_list\Entity\PaymentMethodListEntityInterface
   *   The called Payment Method entity entity.
   */
  public function setName($name);

  /**
   * Gets the Payment Method entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Payment Method entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Payment Method entity creation timestamp.
   *
   * @param int $timestamp
   *   The Payment Method entity creation timestamp.
   *
   * @return \Drupal\payment_method_list\Entity\PaymentMethodListEntityInterface
   *   The called Payment Method entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Payment Method entity published status indicator.
   *
   * Unpublished Payment Method entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Payment Method entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Payment Method entity.
   *
   * @param bool $published
   *   TRUE to set this Payment Method entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\payment_method_list\Entity\PaymentMethodListEntityInterface
   *   The called Payment Method entity entity.
   */
  public function setPublished($published);

}
