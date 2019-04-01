<?php

namespace Drupal\vip_modal;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Vip Modal Content Entity entity.
 *
 * @see \Drupal\vip_modal\Entity\VipModalContent.
 */
class VipModalContentAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\vip_modal\Entity\VipModalContentInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished vip modal content entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published vip modal content entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit vip modal content entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete vip modal content entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add vip modal content entity entities');
  }

}
