<?php

namespace Drupal\zipang_big_winner;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Zipang big winner entity entity.
 *
 * @see \Drupal\zipang_big_winner\Entity\ZipangBigWinnerEntity.
 */
class ZipangBigWinnerEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\zipang_big_winner\Entity\ZipangBigWinnerEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished zipang big winner entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published zipang big winner entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit zipang big winner entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete zipang big winner entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add zipang big winner entity entities');
  }

}
