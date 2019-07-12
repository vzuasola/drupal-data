<?php

namespace Drupal\jamboree_desktop_games;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Jamboree desktop games entity entity.
 *
 * @see \Drupal\jamboree_desktop_games\Entity\JamboreeDesktopGamesEntity.
 */
class JamboreeDesktopGamesEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\jamboree_desktop_games\Entity\JamboreeDesktopGamesEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished jamboree desktop games entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published jamboree desktop games entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit jamboree desktop games entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete jamboree desktop games entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add jamboree desktop games entity entities');
  }

}
