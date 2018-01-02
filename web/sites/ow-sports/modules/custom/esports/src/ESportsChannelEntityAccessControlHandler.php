<?php

namespace Drupal\esports;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Esports channel entity entity.
 *
 * @see \Drupal\esports\Entity\ESportsChannelEntity.
 */
class ESportsChannelEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\esports\Entity\ESportsChannelEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished esports channel entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published esports channel entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit esports channel entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete esports channel entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add esports channel entity entities');
  }

}
