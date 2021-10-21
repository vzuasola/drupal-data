<?php

namespace Drupal\desktop_game_collection;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for theDesktop game collection entity.
 *
 * @see \Drupal\desktop_game_collection\Entity\DesktopGameCollection.
 */
class DesktopGameCollectionAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\desktop_game_collection\Entity\DesktopGameCollectionInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublisheddesktop game collection entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view publisheddesktop game collection entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'editdesktop game collection entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'deletedesktop game collection entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'adddesktop game collection entities');
  }
  
}
