<?php

namespace Drupal\jamboree_live_games;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Jamboree live game entity entity.
 *
 * @see \Drupal\jamboree_live_games\Entity\JamboreeLiveGameEntity.
 */
class JamboreeLiveGameEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\jamboree_live_games\Entity\JamboreeLiveGameEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished jamboree live game entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published jamboree live game entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit jamboree live game entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete jamboree live game entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add jamboree live game entity entities');
  }

}
