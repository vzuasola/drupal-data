<?php

namespace Drupal\zedbet_payments;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Zedbet payment entity.
 *
 * @see \Drupal\zedbet_payments\Entity\ZedbetPayment.
 */
class ZedbetPaymentAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
    protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
        /** @var \Drupal\zedbet_payments\Entity\ZedbetPaymentInterface $entity */
        switch ($operation) {
          case 'view':
            if (!$entity->isPublished()) {
                return AccessResult::allowedIfHasPermission($account, 'view unpublished zedbet payment entities');
            }
            return AccessResult::allowedIfHasPermission($account, 'view published zedbet payment entities');

          case 'update':
            return AccessResult::allowedIfHasPermission($account, 'edit zedbet payment entities');

          case 'delete':
            return AccessResult::allowedIfHasPermission($account, 'delete zedbet payment entities');
        }

        // Unknown operation, no opinion.
        return AccessResult::neutral();
    }

    /**
     * {@inheritdoc}
     */
    protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = null) {
        return AccessResult::allowedIfHasPermission($account, 'add zedbet payment entities');
    }
}
