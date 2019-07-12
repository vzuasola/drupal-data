<?php

namespace Drupal\contact_tabs;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Contact tabs entity entity.
 *
 * @see \Drupal\contact_tabs\Entity\ContactTabsEntity.
 */
class ContactTabsEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\contact_tabs\Entity\ContactTabsEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished contact tabs entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published contact tabs entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit contact tabs entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete contact tabs entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add contact tabs entity entities');
  }

}
