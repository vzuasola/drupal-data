<?php

namespace Drupal\desktop_collection;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for theDesktop collection entity.
 *
 * @see \Drupal\desktop_collection\Entity\DesktopCollection.
 */
class DesktopCollectionAccessControlHandler extends EntityAccessControlHandler {
  
  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\desktop_collection\Entity\DesktopCollectionInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublisheddesktop collection entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view publisheddesktop collection entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'editdesktop collection entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'deletedesktop collection entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'adddesktop collection entities');
  }
  
}
