<?php

namespace Drupal\zipang_fair_gaming;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Zipang fair gaming entity entity.
 *
 * @see \Drupal\zipang_fair_gaming\Entity\ZipangFairGamingEntity.
 */
class ZipangFairGamingEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\zipang_fair_gaming\Entity\ZipangFairGamingEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished zipang fair gaming entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published zipang fair gaming entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit zipang fair gaming entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete zipang fair gaming entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add zipang fair gaming entity entities');
  }

}
