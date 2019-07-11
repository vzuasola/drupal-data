<?php

namespace Drupal\zipang_mobile_blocks;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Zipang mobile block entity entity.
 *
 * @see \Drupal\zipang_mobile_blocks\Entity\ZipangMobileBlockEntity.
 */
class ZipangMobileBlockEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\zipang_mobile_blocks\Entity\ZipangMobileBlockEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished Zipang mobile block entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published Zipang mobile block entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit Zipang mobile block entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete Zipang mobile block entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add Zipang mobile block entity entities');
  }

}
