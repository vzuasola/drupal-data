<?php

namespace Drupal\webcomposer_downloadables;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Downloadable entity entity.
 *
 * @see \Drupal\webcomposer_downloadables\Entity\DownloadableEntity.
 */
class DownloadableEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\webcomposer_downloadables\Entity\DownloadableEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished downloadable entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published downloadable entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit downloadable entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete downloadable entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add downloadable entity entities');
  }

}
