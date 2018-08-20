<?php

namespace Drupal\jamboree_big_winner;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Jamboree big winner entity entity.
 *
 * @see \Drupal\jamboree_big_winner\Entity\JamboreeBigWinnerEntity.
 */
class JamboreeBigWinnerEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\jamboree_big_winner\Entity\JamboreeBigWinnerEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished jamboree big winner entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published jamboree big winner entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit jamboree big winner entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete jamboree big winner entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add jamboree big winner entity entities');
  }

}
