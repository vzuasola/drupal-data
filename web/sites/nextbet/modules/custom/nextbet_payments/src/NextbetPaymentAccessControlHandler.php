<?php

namespace Drupal\nextbet_payments;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Nextbet payment entity.
 *
 * @see \Drupal\nextbet_payments\Entity\NextbetPayment.
 */
class NextbetPaymentAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
    protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
        /** @var \Drupal\nextbet_payments\Entity\NextbetPaymentInterface $entity */
        switch ($operation) {
          case 'view':
            if (!$entity->isPublished()) {
                return AccessResult::allowedIfHasPermission($account, 'view unpublished nextbet payment entities');
            }
            return AccessResult::allowedIfHasPermission($account, 'view published nextbet payment entities');

          case 'update':
            return AccessResult::allowedIfHasPermission($account, 'edit nextbet payment entities');

          case 'delete':
            return AccessResult::allowedIfHasPermission($account, 'delete nextbet payment entities');
        }

        // Unknown operation, no opinion.
        return AccessResult::neutral();
    }

    /**
     * {@inheritdoc}
     */
    protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = null) {
        return AccessResult::allowedIfHasPermission($account, 'add nextbet payment entities');
    }
}
