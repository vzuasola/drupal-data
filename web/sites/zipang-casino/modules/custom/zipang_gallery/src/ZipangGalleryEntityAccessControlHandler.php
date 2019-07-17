<?php

namespace Drupal\zipang_gallery;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Zipang gallery entity entity.
 *
 * @see \Drupal\zipang_gallery\Entity\ZipangGalleryEntity.
 */
class ZipangGalleryEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\zipang_gallery\Entity\ZipangGalleryEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished zipang gallery entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published zipang gallery entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit zipang gallery entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete zipang gallery entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add zipang gallery entity entities');
  }

}
