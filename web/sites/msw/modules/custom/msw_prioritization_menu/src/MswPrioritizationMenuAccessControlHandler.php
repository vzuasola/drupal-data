<?php

namespace Drupal\msw_prioritization_menu;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Video Call Prioritization Menu entity.
 *
 * @see \Drupal\msw_prioritization_menu\Entity\MswPrioritizationMenu.
 */
class MswPrioritizationMenuAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\msw_prioritization_menu\Entity\MswPrioritizationMenuInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished msw video call prioritization menu entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published msw video call prioritization menu entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit msw video call prioritization menu entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete msw video call prioritization menu entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add msw video call prioritization menu entities');
  }

}
