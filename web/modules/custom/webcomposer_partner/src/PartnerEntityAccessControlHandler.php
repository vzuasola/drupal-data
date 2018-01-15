<?php

namespace Drupal\webcomposer_partner;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Partner entity entity.
 *
 * @see \Drupal\webcomposer_partner\Entity\PartnerEntity.
 */
class PartnerEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\webcomposer_partner\Entity\PartnerEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished partner entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published partner entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit partner entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete partner entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add partner entity entities');
  }

}
