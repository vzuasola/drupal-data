<?php

namespace Drupal\rightside_block;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Rightside block entity entity.
 *
 * @see \Drupal\rightside_block\Entity\RightsideBlockEntity.
 */
class RightsideBlockEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\rightside_block\Entity\RightsideBlockEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished rightside block entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published rightside block entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit rightside block entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete rightside block entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add rightside block entity entities');
  }

}
