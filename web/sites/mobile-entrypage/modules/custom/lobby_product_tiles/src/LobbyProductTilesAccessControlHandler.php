<?php

namespace Drupal\lobby_product_tiles;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Lobby Product Tiles entity.
 *
 * @see \Drupal\lobby_product_tiles\Entity\LobbyProductTiles.
 */
class LobbyProductTilesAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\lobby_product_tiles\Entity\LobbyProductTilesInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished lobby product tiles entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published lobby product tiles entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit lobby product tiles entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete lobby product tiles entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add lobby product tiles entities');
  }

}
