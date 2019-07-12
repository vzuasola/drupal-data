<?php

namespace Drupal\zipang_press;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Zipang press entity entity.
 *
 * @see \Drupal\zipang_press\Entity\ZipangPressEntity.
 */
class ZipangPressEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\zipang_press\Entity\ZipangPressEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished zipang press entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published zipang press entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit zipang press entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete zipang press entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add zipang press entity entities');
  }

}
