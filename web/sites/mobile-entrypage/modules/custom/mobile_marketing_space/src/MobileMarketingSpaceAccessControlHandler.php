<?php

namespace Drupal\mobile_marketing_space;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Mobile marketing space entity.
 *
 * @see \Drupal\mobile_marketing_space\Entity\MobileMarketingSpace.
 */
class MobileMarketingSpaceAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\mobile_marketing_space\Entity\MobileMarketingSpaceInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished mobile marketing space entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published mobile marketing space entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit mobile marketing space entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete mobile marketing space entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add mobile marketing space entities');
  }

}
