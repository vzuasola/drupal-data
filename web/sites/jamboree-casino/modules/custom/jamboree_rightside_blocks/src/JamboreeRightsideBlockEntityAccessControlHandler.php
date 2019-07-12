<?php

namespace Drupal\jamboree_rightside_blocks;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Jamboree rightside block entity entity.
 *
 * @see \Drupal\jamboree_rightside_blocks\Entity\JamboreeRightsideBlockEntity.
 */
class JamboreeRightsideBlockEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\jamboree_rightside_blocks\Entity\JamboreeRightsideBlockEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished jamboree rightside block entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published jamboree rightside block entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit jamboree rightside block entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete jamboree rightside block entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add jamboree rightside block entity entities');
  }

}
