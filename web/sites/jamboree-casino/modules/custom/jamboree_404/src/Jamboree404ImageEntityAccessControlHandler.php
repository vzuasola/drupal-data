<?php

namespace Drupal\jamboree_404;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Jamboree 404 Image Entity entity.
 *
 * @see \Drupal\jamboree_404\Entity\Jamboree404ImageEntity.
 */
class Jamboree404ImageEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\jamboree_404\Entity\Jamboree404ImageEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished jamboree 404 image entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published jamboree 404 image entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit jamboree 404 image entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete jamboree 404 image entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add jamboree 404 image entity entities');
  }

}
