<?php

namespace Drupal\zipang_promotions;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Zipang promotions entity entity.
 *
 * @see \Drupal\zipang_promotions\Entity\ZipangPromotionsEntity.
 */
class ZipangPromotionsEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\zipang_promotions\Entity\ZipangPromotionsEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished zipang promotions entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published zipang promotions entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit zipang promotions entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete zipang promotions entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add zipang promotions entity entities');
  }

}
