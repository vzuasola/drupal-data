<?php

namespace Drupal\client_footer_games;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Client footer games entity.
 *
 * @see \Drupal\client_footer_games\Entity\ClientFooterGames.
 */
class ClientFooterGamesAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\client_footer_games\Entity\ClientFooterGamesInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished client footer games entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published client footer games entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit client footer games entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete client footer games entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add client footer games entities');
  }

}
