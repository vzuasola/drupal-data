<?php

namespace Drupal\jamboree_payment_method\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Payment method entity entities.
 *
 * @ingroup jamboree_payment_method
 */
interface PaymentMethodEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Payment method entity name.
   *
   * @return string
   *   Name of the Payment method entity.
   */
  public function getName();

  /**
   * Sets the Payment method entity name.
   *
   * @param string $name
   *   The Payment method entity name.
   *
   * @return \Drupal\jamboree_payment_method\Entity\PaymentMethodEntityInterface
   *   The called Payment method entity entity.
   */
  public function setName($name);

  /**
   * Gets the Payment method entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Payment method entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Payment method entity creation timestamp.
   *
   * @param int $timestamp
   *   The Payment method entity creation timestamp.
   *
   * @return \Drupal\jamboree_payment_method\Entity\PaymentMethodEntityInterface
   *   The called Payment method entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Payment method entity published status indicator.
   *
   * Unpublished Payment method entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Payment method entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Payment method entity.
   *
   * @param bool $published
   *   TRUE to set this Payment method entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\jamboree_payment_method\Entity\PaymentMethodEntityInterface
   *   The called Payment method entity entity.
   */
  public function setPublished($published);

}
