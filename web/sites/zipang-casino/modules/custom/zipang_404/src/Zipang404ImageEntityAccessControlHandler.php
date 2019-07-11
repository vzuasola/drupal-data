<?php

namespace Drupal\zipang_404;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Zipang 404 Image Entity entity.
 *
 * @see \Drupal\zipang_404\Entity\Zipang404ImageEntity.
 */
class Zipang404ImageEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\zipang_404\Entity\Zipang404ImageEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished Zipang 404 image entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published Zipang 404 image entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit Zipang 404 image entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete Zipang 404 image entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add Zipang 404 image entity entities');
  }

}
