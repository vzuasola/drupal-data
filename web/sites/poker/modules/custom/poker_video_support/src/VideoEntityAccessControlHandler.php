<?php

namespace Drupal\poker_video_support;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Video entity entity.
 *
 * @see \Drupal\poker_video_support\Entity\VideoEntity.
 */
class VideoEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\poker_video_support\Entity\VideoEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished video entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published video entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit video entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete video entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add video entity entities');
  }

}
