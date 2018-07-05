<?php

namespace Drupal\jamboree_desktop_blocks;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Jamboree desktop block entity.
 *
 * @see \Drupal\jamboree_desktop_blocks\Entity\JamboreeDesktopBlock.
 */
class JamboreeDesktopBlockAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\jamboree_desktop_blocks\Entity\JamboreeDesktopBlockInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished jamboree desktop block entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published jamboree desktop block entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit jamboree desktop block entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete jamboree desktop block entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add jamboree desktop block entities');
  }

}
