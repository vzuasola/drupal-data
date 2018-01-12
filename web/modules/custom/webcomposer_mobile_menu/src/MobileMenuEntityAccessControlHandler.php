<?php

namespace Drupal\webcomposer_mobile_menu;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Mobile menu entity entity.
 *
 * @see \Drupal\webcomposer_mobile_menu\Entity\MobileMenuEntity.
 */
class MobileMenuEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\webcomposer_mobile_menu\Entity\MobileMenuEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished mobile menu entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published mobile menu entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit mobile menu entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete mobile menu entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add mobile menu entity entities');
  }

}
