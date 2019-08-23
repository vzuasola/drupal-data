<?php

namespace Drupal\mobilehub;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Mobile tiles entity.
 *
 * @see \Drupal\mobilehub\Entity\MobileTiles.
 */
class MobileTilesAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\mobilehub\Entity\MobileTilesInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished mobile tiles entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published mobile tiles entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit mobile tiles entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete mobile tiles entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add mobile tiles entities');
  }

}
