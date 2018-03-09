<?php

namespace Drupal\exchange_lobby_tile;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the exchange lobby tile entity entity.
 *
 * @see \Drupal\exchange_lobby_tile\Entity\ExchangeLobbyTileEntity.
 */
class ExchangeLobbyTileEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\exchange_lobby_tile\Entity\ExchangeLobbyTileEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished exchange lobby tile entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published exchange lobby tile entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit exchange lobby tile entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete exchange lobby tile entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add exchange lobby tile entity entities');
  }

}
