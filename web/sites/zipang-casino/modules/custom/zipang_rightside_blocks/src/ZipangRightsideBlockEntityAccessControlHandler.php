<?php

namespace Drupal\zipang_rightside_blocks;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Zipang rightside block entity entity.
 *
 * @see \Drupal\zipang_rightside_blocks\Entity\ZipangRightsideBlockEntity.
 */
class ZipangRightsideBlockEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\zipang_rightside_blocks\Entity\ZipangRightsideBlockEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished zipang rightside block entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published zipang rightside block entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit zipang rightside block entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete zipang rightside block entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add zipang rightside block entity entities');
  }

}
