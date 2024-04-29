<?php

namespace Drupal\payment_method_list;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Payment Method entity entity.
 *
 * @see \Drupal\payment_method_list\Entity\PaymentMethodListEntity.
 */
class PaymentMethodListEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\payment_method_list\Entity\PaymentMethodListEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished payment method list entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published payment method list entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit payment method list entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete payment method list entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add payment method list entity entities');
  }

}
