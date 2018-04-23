<?php

namespace Drupal\keno_lobby_tile;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Keno lobby tile entity entity.
 *
 * @see \Drupal\keno_lobby_tile\Entity\KenoLobbyTileEntity.
 */
class KenoLobbyTileEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\keno_lobby_tile\Entity\KenoLobbyTileEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished keno lobby tile entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published keno lobby tile entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit keno lobby tile entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete keno lobby tile entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add keno lobby tile entity entities');
  }

}
