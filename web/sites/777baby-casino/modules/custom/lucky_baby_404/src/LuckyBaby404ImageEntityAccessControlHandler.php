<?php

namespace Drupal\lucky_baby_404;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Lucky Baby 404 Image Entity entity.
 *
 * @see \Drupal\lucky_baby_404\Entity\LuckyBaby404ImageEntity.
 */
class LuckyBaby404ImageEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\lucky_baby_404\Entity\LuckyBaby404ImageEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished lucky baby 404 image entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published lucky baby 404 image entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit lucky baby 404 image entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete lucky baby 404 image entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add lucky baby 404 image entity entities');
  }

}
