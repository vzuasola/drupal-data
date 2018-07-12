<?php

namespace Drupal\jamboree_mobile_blocks;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Jamboree mobile block entity entity.
 *
 * @see \Drupal\jamboree_mobile_blocks\Entity\JamboreeMobileBlockEntity.
 */
class JamboreeMobileBlockEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\jamboree_mobile_blocks\Entity\JamboreeMobileBlockEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished jamboree mobile block entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published jamboree mobile block entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit jamboree mobile block entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete jamboree mobile block entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add jamboree mobile block entity entities');
  }

}
