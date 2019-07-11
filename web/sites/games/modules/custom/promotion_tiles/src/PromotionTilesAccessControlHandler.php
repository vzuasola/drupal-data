<?php

namespace Drupal\promotion_tiles;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Promotion tiles entity.
 *
 * @see \Drupal\promotion_tiles\Entity\PromotionTiles.
 */
class PromotionTilesAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\promotion_tiles\Entity\PromotionTilesInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished promotion tiles entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published promotion tiles entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit promotion tiles entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete promotion tiles entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add promotion tiles entities');
  }

}
