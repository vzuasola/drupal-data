<?php

namespace Drupal\poker_download_page;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Download page entity entity.
 *
 * @see \Drupal\poker_download_page\Entity\DownloadPageEntity.
 */
class DownloadPageEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\poker_download_page\Entity\DownloadPageEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished download page entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published download page entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit download page entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete download page entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add download page entity entities');
  }

}
