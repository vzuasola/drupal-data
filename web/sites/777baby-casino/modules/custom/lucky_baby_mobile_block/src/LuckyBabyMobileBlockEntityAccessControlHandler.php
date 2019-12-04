<?php

namespace Drupal\lucky_baby_mobile_block;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Lucky baby mobile block entity entity.
 *
 * @see \Drupal\lucky_baby_mobile_block\Entity\LuckyBabyMobileBlockEntity.
 */
class LuckyBabyMobileBlockEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\lucky_baby_mobile_block\Entity\LuckyBabyMobileBlockEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished lucky baby mobile block entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published lucky baby mobile block entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit lucky baby mobile block entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete lucky baby mobile block entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add lucky baby mobile block entity entities');
  }

}
