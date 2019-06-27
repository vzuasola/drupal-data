<?php

namespace Drupal\deposit_and_withdrawal;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Deposit and withdrawal entity entity.
 *
 * @see \Drupal\deposit_and_withdrawal\Entity\DepositAndWithdrawalEntity.
 */
class DepositAndWithdrawalEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\deposit_and_withdrawal\Entity\DepositAndWithdrawalEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished deposit and withdrawal entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published deposit and withdrawal entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit deposit and withdrawal entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete deposit and withdrawal entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add deposit and withdrawal entity entities');
  }

}
