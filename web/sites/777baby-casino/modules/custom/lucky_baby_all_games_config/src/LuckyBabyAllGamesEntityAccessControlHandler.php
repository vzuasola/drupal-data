<?php

namespace Drupal\lucky_baby_all_games_config;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the lucky baby all games entity entity.
 *
 * @see \Drupal\lucky_baby_all_games_config\Entity\lucky babyAllGamesEntity.
 */
class LuckyBabyAllGamesEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\lucky_baby_all_games_config\Entity\lucky babyAllGamesEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished lucky baby all games entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published lucky baby all games entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit lucky baby all games entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete lucky baby all games entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add lucky baby all games entity entities');
  }

}
