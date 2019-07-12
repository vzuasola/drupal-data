<?php

namespace Drupal\deposit_and_withdrawal\Entity;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface for defining Deposit and withdrawal entity entities.
 *
 * @ingroup deposit_and_withdrawal
 */
interface DepositAndWithdrawalEntityInterface extends  ContentEntityInterface, EntityChangedInterface, EntityOwnerInterface {

  // Add get/set methods for your configuration properties here.

  /**
   * Gets the Deposit and withdrawal entity name.
   *
   * @return string
   *   Name of the Deposit and withdrawal entity.
   */
  public function getName();

  /**
   * Sets the Deposit and withdrawal entity name.
   *
   * @param string $name
   *   The Deposit and withdrawal entity name.
   *
   * @return \Drupal\deposit_and_withdrawal\Entity\DepositAndWithdrawalEntityInterface
   *   The called Deposit and withdrawal entity entity.
   */
  public function setName($name);

  /**
   * Gets the Deposit and withdrawal entity creation timestamp.
   *
   * @return int
   *   Creation timestamp of the Deposit and withdrawal entity.
   */
  public function getCreatedTime();

  /**
   * Sets the Deposit and withdrawal entity creation timestamp.
   *
   * @param int $timestamp
   *   The Deposit and withdrawal entity creation timestamp.
   *
   * @return \Drupal\deposit_and_withdrawal\Entity\DepositAndWithdrawalEntityInterface
   *   The called Deposit and withdrawal entity entity.
   */
  public function setCreatedTime($timestamp);

  /**
   * Returns the Deposit and withdrawal entity published status indicator.
   *
   * Unpublished Deposit and withdrawal entity are only visible to restricted users.
   *
   * @return bool
   *   TRUE if the Deposit and withdrawal entity is published.
   */
  public function isPublished();

  /**
   * Sets the published status of a Deposit and withdrawal entity.
   *
   * @param bool $published
   *   TRUE to set this Deposit and withdrawal entity to published, FALSE to set it to unpublished.
   *
   * @return \Drupal\deposit_and_withdrawal\Entity\DepositAndWithdrawalEntityInterface
   *   The called Deposit and withdrawal entity entity.
   */
  public function setPublished($published);

}
