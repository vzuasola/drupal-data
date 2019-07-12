<?php

namespace Drupal\zipang_special_promotions_notif;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Zipang special promotions entity entity.
 *
 * @see \Drupal\zipang_special_promotions_notif\Entity\ZipangSpecialPromotionsEntity.
 */
class ZipangSpecialPromotionsEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\zipang_special_promotions_notif\Entity\ZipangSpecialPromotionsEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished zipang special promotions entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published zipang special promotions entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit zipang special promotions entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete zipang special promotions entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add zipang special promotions entity entities');
  }

}
