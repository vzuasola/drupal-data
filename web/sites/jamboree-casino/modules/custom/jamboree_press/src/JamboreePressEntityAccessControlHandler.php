<?php

namespace Drupal\jamboree_press;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Jamboree press entity entity.
 *
 * @see \Drupal\jamboree_press\Entity\JamboreePressEntity.
 */
class JamboreePressEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\jamboree_press\Entity\JamboreePressEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished jamboree press entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published jamboree press entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit jamboree press entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete jamboree press entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add jamboree press entity entities');
  }

}
