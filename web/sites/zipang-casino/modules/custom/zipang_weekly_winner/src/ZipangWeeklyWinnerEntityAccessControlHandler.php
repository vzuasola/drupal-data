<?php

namespace Drupal\zipang_weekly_winner;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Zipang weekly winner entity entity.
 *
 * @see \Drupal\zipang_weekly_winner\Entity\ZipangWeeklyWinnerEntity.
 */
class ZipangWeeklyWinnerEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\zipang_weekly_winner\Entity\ZipangWeeklyWinnerEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished zipang weekly winner entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published zipang weekly winner entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit zipang weekly winner entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete zipang weekly winner entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add zipang weekly winner entity entities');
  }

}
