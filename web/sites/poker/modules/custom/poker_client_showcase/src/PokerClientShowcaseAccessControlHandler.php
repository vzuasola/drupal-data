<?php

namespace Drupal\poker_client_showcase;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Poker client showcase entity.
 *
 * @see \Drupal\poker_client_showcase\Entity\PokerClientShowcase.
 */
class PokerClientShowcaseAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\poker_client_showcase\Entity\PokerClientShowcaseInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished poker client showcase entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published poker client showcase entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit poker client showcase entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete poker client showcase entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add poker client showcase entities');
  }

}
