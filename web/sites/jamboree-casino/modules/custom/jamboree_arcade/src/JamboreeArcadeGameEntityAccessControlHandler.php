<?php

namespace Drupal\jamboree_arcade;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Jamboree arcade game entity entity.
 *
 * @see \Drupal\jamboree_arcade\Entity\JamboreeArcadeGameEntity.
 */
class JamboreeArcadeGameEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\jamboree_arcade\Entity\JamboreeArcadeGameEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished jamboree arcade game entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published jamboree arcade game entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit jamboree arcade game entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete jamboree arcade game entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add jamboree arcade game entity entities');
  }

}
