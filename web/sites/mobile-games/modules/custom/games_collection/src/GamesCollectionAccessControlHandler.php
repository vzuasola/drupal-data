<?php

namespace Drupal\games_collection;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Games Collection entity.
 *
 * @see \Drupal\games_collection\Entity\GamesCollection.
 */
class GamesCollectionAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\games_collection\Entity\GamesCollectionInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished games collection entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published games collection entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit games collection entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete games collection entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add games collection entities');
  }

}
