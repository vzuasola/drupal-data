<?php

namespace Drupal\jamboree_weekly_winner;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Jamboree weekly winner entity entity.
 *
 * @see \Drupal\jamboree_weekly_winner\Entity\JamboreeWeeklyWinnerEntity.
 */
class JamboreeWeeklyWinnerEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\jamboree_weekly_winner\Entity\JamboreeWeeklyWinnerEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished jamboree weekly winner entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published jamboree weekly winner entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit jamboree weekly winner entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete jamboree weekly winner entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add jamboree weekly winner entity entities');
  }

}
