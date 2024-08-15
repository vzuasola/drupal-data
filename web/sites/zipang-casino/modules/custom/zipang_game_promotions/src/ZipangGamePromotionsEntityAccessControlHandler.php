<?php

namespace Drupal\zipang_game_promotions;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Zipang game promotions entity entity.
 *
 * @see \Drupal\zipang_game_promotions\Entity\ZipangGamePromotionsEntity.
 */
class ZipangGamePromotionsEntityAccessControlHandler extends EntityAccessControlHandler {  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\zipang_game_promotions\Entity\ZipangGamePromotionsEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished zipang game promotions entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published zipang game promotions entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit zipang game promotions entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete zipang game promotions entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add zipang game promotions entity entities');
  }
}
