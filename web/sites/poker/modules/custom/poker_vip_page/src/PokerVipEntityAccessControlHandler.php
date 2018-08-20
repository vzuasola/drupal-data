<?php

namespace Drupal\poker_vip_page;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Poker vip entity entity.
 *
 * @see \Drupal\poker_vip_page\Entity\PokerVipEntity.
 */
class PokerVipEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\poker_vip_page\Entity\PokerVipEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished poker vip entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published poker vip entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit poker vip entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete poker vip entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add poker vip entity entities');
  }

}
