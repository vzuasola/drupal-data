<?php

namespace Drupal\jamboree_content_blocks;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Content block entity entity.
 *
 * @see \Drupal\jamboree_content_blocks\Entity\ContentBlockEntity.
 */
class ContentBlockEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\jamboree_content_blocks\Entity\ContentBlockEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished content block entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published content block entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit content block entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete content block entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add content block entity entities');
  }

}
