<?php

namespace Drupal\mobile_collection;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the mobile collection entity.
 *
 * @see \Drupal\mobile_collection\Entity\MobileCollection.
 */
class MobileCollectionAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\mobile_collection\Entity\MobileCollectionInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished mobile collection entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published mobile collection entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit mobile collection entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete mobile collection entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add mobile collection entities');
  }

}
