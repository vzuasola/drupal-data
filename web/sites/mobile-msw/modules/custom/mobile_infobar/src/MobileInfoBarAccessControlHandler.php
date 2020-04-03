<?php

namespace Drupal\mobile_infobar;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Mobile info bar entity.
 *
 * @see \Drupal\mobile_infobar\Entity\MobileInfoBar.
 */
class MobileInfoBarAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\mobile_infobar\Entity\MobileInfoBarInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished mobile info bar entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published mobile info bar entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit mobile info bar entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete mobile info bar entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add mobile info bar entities');
  }

}
