<?php

namespace Drupal\msw_front_blocks;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the msw front block entity.
 *
 * @see \Drupal\msw_front_blocks\Entity\MswFrontBlock.
 */
class MswFrontBlockAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\msw_front_blocks\Entity\MswFrontBlockInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished msw front block entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published msw front block entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit msw front block entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete msw front block entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add msw front block entities');
  }

}
