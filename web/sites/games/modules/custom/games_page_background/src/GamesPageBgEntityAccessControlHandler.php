<?php

namespace Drupal\games_page_background;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Games Page Background entity.
 *
 * @see \Drupal\games_page_background\Entity\GamesPageBgEntity.
 */
class GamesPageBgEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\games_page_background\Entity\GamesPageBgEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished games page background entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published games page background entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit games page background entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete games page background entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add games page background entities');
  }

}
