<?php

namespace Drupal\zipang_mobile_games;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Zipang mobile games entity entity.
 *
 * @see \Drupal\zipang_mobile_games\Entity\ZipangMobileGamesEntity.
 */
class ZipangMobileGamesEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\zipang_mobile_games\Entity\ZipangMobileGamesEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished zipang mobile games entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published zipang mobile games entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit zipang mobile games entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete zipang mobile games entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add zipang mobile games entity entities');
  }

}
