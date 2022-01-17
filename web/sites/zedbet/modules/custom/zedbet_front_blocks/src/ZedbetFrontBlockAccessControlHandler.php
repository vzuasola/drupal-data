<?php

namespace Drupal\zedbet_front_blocks;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Zedbet front block entity.
 *
 * @see \Drupal\zedbet_front_blocks\Entity\ZedbetFrontBlock.
 */
class ZedbetFrontBlockAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\zedbet_front_blocks\Entity\ZedbetFrontBlockInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished zedbet front block entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published zedbet front block entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit zedbet front block entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete zedbet front block entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add zedbet front block entities');
  }

}
