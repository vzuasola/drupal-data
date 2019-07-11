<?php

namespace Drupal\mobile_product_menu;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Mobile Product Menu entity.
 *
 * @see \Drupal\mobile_product_menu\Entity\MobileProductMenu.
 */
class MobileProductMenuAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\mobile_product_menu\Entity\MobileProductMenuInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished mobile product menu entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published mobile product menu entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit mobile product menu entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete mobile product menu entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add mobile product menu entities');
  }

}
