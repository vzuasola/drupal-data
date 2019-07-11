<?php

namespace Drupal\poker_client_promotions;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Poker client promotions entity.
 *
 * @see \Drupal\poker_client_promotions\Entity\PokerClientPromotions.
 */
class PokerClientPromotionsAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\poker_client_promotions\Entity\PokerClientPromotionsInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished poker client promotions entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published poker client promotions entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit poker client promotions entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete poker client promotions entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add poker client promotions entities');
  }

}
