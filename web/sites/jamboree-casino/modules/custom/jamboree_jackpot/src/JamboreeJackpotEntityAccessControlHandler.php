<?php

namespace Drupal\jamboree_jackpot;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Jamboree jackpot entity entity.
 *
 * @see \Drupal\jamboree_jackpot\Entity\JamboreeJackpotEntity.
 */
class JamboreeJackpotEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\jamboree_jackpot\Entity\JamboreeJackpotEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished jamboree jackpot entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published jamboree jackpot entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit jamboree jackpot entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete jamboree jackpot entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add jamboree jackpot entity entities');
  }

}
