<?php

namespace Drupal\ghana_quick_links;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Quick links entity entity.
 *
 * @see \Drupal\ghana_quick_links\Entity\QuickLinksEntity.
 */
class QuickLinksEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\ghana_quick_links\Entity\QuickLinksEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished quick links entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published quick links entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit quick links entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete quick links entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add quick links entity entities');
  }

}
