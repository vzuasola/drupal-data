<?php

namespace Drupal\jamboree_games;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Games entity entity.
 *
 * @see \Drupal\jamboree_games\Entity\GamesEntity.
 */
class GamesEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\jamboree_games\Entity\GamesEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished games entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published games entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit games entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete games entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add games entity entities');
  }

}
