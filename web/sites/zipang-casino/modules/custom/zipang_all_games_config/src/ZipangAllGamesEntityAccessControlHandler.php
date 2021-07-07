<?php

namespace Drupal\zipang_all_games_config;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Zipang all games entity entity.
 *
 * @see \Drupal\zipang_all_games_config\Entity\ZipangAllGamesEntity.
 */
class ZipangAllGamesEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\zipang_all_games_config\Entity\ZipangAllGamesEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished zipang all games entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published zipang all games entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit zipang all games entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete zipang all games entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add zipang all games entity entities');
  }

}
