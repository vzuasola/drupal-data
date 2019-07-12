<?php

namespace Drupal\webcomposer_floating_banners;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Left floating banner entity entity.
 *
 * @see \Drupal\webcomposer_floating_banners\Entity\LeftFloatingBannerEntity.
 */
class LeftFloatingBannerEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\webcomposer_floating_banners\Entity\LeftFloatingBannerEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished left floating banner entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published left floating banner entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit left floating banner entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete left floating banner entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add left floating banner entity entities');
  }

}
