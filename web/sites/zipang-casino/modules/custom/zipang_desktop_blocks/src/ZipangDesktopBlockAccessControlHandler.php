<?php

namespace Drupal\zipang_desktop_blocks;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Zipang desktop block entity.
 *
 * @see \Drupal\zipang_desktop_blocks\Entity\ZipangDesktopBlock.
 */
class ZipangDesktopBlockAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\zipang_desktop_blocks\Entity\ZipangDesktopBlockInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished zipang desktop block entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published zipang desktop block entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit zipang desktop block entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete zipang desktop block entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add zipang desktop block entities');
  }

}
