<?php

namespace Drupal\webcomposer_right_side_block;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Inner Page Right Side Block entity.
 *
 * @see \Drupal\webcomposer_right_side_block\Entity\RightSideBlockEntity.
 */
class RightSideBlockEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\webcomposer_right_side_block\Entity\RightSideBlockEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished inner page right side block entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published inner page right side block entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit inner page right side block entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete inner page right side block entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add inner page right side block entities');
  }

}
