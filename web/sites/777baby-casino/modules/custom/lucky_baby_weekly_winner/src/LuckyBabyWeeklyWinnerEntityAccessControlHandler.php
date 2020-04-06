<?php

namespace Drupal\lucky_baby_weekly_winner;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Lucky baby weekly winner entity entity.
 *
 * @see \Drupal\lucky_baby_weekly_winner\Entity\LuckyBabyWeeklyWinnerEntity.
 */
class LuckyBabyWeeklyWinnerEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\lucky_baby_weekly_winner\Entity\LuckyBabyWeeklyWinnerEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished lucky baby weekly winner entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published lucky baby weekly winner entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit lucky baby weekly winner entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete lucky baby weekly winner entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add lucky baby weekly winner entity entities');
  }

}
