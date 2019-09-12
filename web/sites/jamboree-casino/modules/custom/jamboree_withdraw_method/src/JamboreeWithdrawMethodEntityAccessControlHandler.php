<?php

namespace Drupal\jamboree_withdraw_method;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Jamboree withdraw method entity entity.
 *
 * @see \Drupal\jamboree_withdraw_method\Entity\JamboreeWithdrawMethodEntity.
 */
class JamboreeWithdrawMethodEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\jamboree_withdraw_method\Entity\JamboreeWithdrawMethodEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished jamboree withdraw method entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published jamboree withdraw method entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit jamboree withdraw method entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete jamboree withdraw method entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add jamboree withdraw method entity entities');
  }

}
