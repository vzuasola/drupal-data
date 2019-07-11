<?php

namespace Drupal\jamboree_fair_gaming;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Jamboree fair gaming entity entity.
 *
 * @see \Drupal\jamboree_fair_gaming\Entity\JamboreeFairGamingEntity.
 */
class JamboreeFairGamingEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\jamboree_fair_gaming\Entity\JamboreeFairGamingEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished jamboree fair gaming entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published jamboree fair gaming entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit jamboree fair gaming entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete jamboree fair gaming entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add jamboree fair gaming entity entities');
  }

}
