<?php

namespace Drupal\jamboree_news_and_updates;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the News and updates entity entity.
 *
 * @see \Drupal\jamboree_news_and_updates\Entity\NewsAndUpdatesEntity.
 */
class NewsAndUpdatesEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\jamboree_news_and_updates\Entity\NewsAndUpdatesEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished news and updates entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published news and updates entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit news and updates entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete news and updates entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add news and updates entity entities');
  }

}
