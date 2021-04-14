<?php

namespace Drupal\jamboree_all_games_config;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Jamboree all games entity entity.
 *
 * @see \Drupal\jamboree_all_games_config\Entity\JamboreeAllGamesEntity.
 */
class JamboreeAllGamesEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\jamboree_all_games_config\Entity\JamboreeAllGamesEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished jamboree all games entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published jamboree all games entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit jamboree all games entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete jamboree all games entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add jamboree all games entity entities');
  }

}
