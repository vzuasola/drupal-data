<?php

namespace Drupal\webcomposer_drawer;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Drawer entity entity.
 *
 * @see \Drupal\webcomposer_drawer\Entity\DrawerEntity.
 */
class DrawerEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\webcomposer_drawer\Entity\DrawerEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished drawer entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published drawer entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit drawer entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete drawer entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add drawer entity entities');
  }

}
