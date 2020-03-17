<?php

namespace Drupal\arcade_collection;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Arcade collection entity.
 *
 * @see \Drupal\arcade_collection\Entity\ArcadeCollection.
 */
class ArcadeCollectionAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\arcade_collection\Entity\ArcadeCollectionInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished arcade collection entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published arcade collection entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit arcade collection entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete arcade collection entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add arcade collection entities');
  }

}
