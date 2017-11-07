<?php

namespace Drupal\games_showcase;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Games Showcase entity entity.
 *
 * @see \Drupal\games_showcase\Entity\GamesShowcaseEntity.
 */
class GamesShowcaseEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\games_showcase\Entity\GamesShowcaseEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished games showcase entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published games showcase entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit games showcase entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete games showcase entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add games showcase entity entities');
  }

}
