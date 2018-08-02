<?php

namespace Drupal\poker_grid_menu;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Grid menu entity entity.
 *
 * @see \Drupal\poker_grid_menu\Entity\GridMenuEntity.
 */
class GridMenuEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\poker_grid_menu\Entity\GridMenuEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished grid menu entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published grid menu entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit grid menu entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete grid menu entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add grid menu entity entities');
  }

}
