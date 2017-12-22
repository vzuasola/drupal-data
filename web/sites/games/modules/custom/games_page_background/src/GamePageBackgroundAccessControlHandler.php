<?php

namespace Drupal\games_page_background;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Game Page Background entity.
 *
 * @see \Drupal\games_page_background\Entity\GamePageBackground.
 */
class GamePageBackgroundAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\games_page_background\Entity\GamePageBackgroundInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished game page Background entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published game page Background entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit game page Background entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete game page Background entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add game page Background entities');
  }

}
