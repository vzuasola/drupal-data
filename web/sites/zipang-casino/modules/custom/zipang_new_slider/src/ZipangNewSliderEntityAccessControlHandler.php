<?php

namespace Drupal\zipang_new_slider;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Zipang new slider entity.
 *
 * @see \Drupal\zipang_new_slider\Entity\ZipangNewSliderEntity.
 */
class ZipangNewSliderEntityAccessControlHandler extends EntityAccessControlHandler {
  
  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\zipang_new_slider\Entity\ZipangNewSliderEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished zipang new slider entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published zipang new slider entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit zipang new slider entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'deletezipang new slider entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add zipang new slider entity entities');
  }
}
