<?php

namespace Drupal\webcomposer_download_page;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Webcomposer download page entity.
 *
 * @see \Drupal\webcomposer_download_page\Entity\WebcomposerDownloadPage.
 */
class WebcomposerDownloadPageAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\webcomposer_download_page\Entity\WebcomposerDownloadPageInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished webcomposer download page entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published webcomposer download page entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit webcomposer download page entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete webcomposer download page entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add webcomposer download page entities');
  }

}
