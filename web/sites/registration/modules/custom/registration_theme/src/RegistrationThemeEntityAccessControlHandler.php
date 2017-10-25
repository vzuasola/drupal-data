<?php

namespace Drupal\registration_theme;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Registration theme entity entity.
 *
 * @see \Drupal\registration_theme\Entity\RegistrationThemeEntity.
 */
class RegistrationThemeEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\registration_theme\Entity\RegistrationThemeEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished registration theme entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published registration theme entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit registration theme entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete registration theme entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add registration theme entity entities');
  }

}
