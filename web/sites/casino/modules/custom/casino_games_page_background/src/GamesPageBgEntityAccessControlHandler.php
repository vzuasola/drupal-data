<?php

namespace Drupal\casino_games_page_background;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Casino Games Page Background entity.
 *
 * @see \Drupal\casino_games_page_background\Entity\GamesPageBgEntity.
 */
class GamesPageBgEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\casino_games_page_background\Entity\GamesPageBgEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished casino games page background entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published casino games page background entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit casino games page background entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete casino games page background entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add casino games page background entities');
  }

}
