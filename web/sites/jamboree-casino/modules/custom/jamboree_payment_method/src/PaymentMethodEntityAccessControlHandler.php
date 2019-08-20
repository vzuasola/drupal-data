<?php

namespace Drupal\jamboree_payment_method;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Payment method entity entity.
 *
 * @see \Drupal\jamboree_payment_method\Entity\PaymentMethodEntity.
 */
class PaymentMethodEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\jamboree_payment_method\Entity\PaymentMethodEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished payment method entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published payment method entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit payment method entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete payment method entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add payment method entity entities');
  }

}
