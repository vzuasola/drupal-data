<?php

namespace Drupal\zipang_dropdown_menu;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Dropdown menu entity entity.
 *
 * @see \Drupal\zipang_dropdown_menu\Entity\DropdownMenuEntity.
 */
class DropdownMenuEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\zipang_dropdown_menu\Entity\DropdownMenuEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished dropdown menu entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published dropdown menu entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit dropdown menu entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete dropdown menu entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add dropdown menu entity entities');
  }

}
