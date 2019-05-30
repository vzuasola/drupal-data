<?php

namespace Drupal\zipang_jackpot;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Zipang jackpot entity entity.
 *
 * @see \Drupal\zipang_jackpot\Entity\ZipangJackpotEntity.
 */
class ZipangJackpotEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\zipang_jackpot\Entity\ZipangJackpotEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished zipang jackpot entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published zipang jackpot entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit zipang jackpot entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete zipang jackpot entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add zipang jackpot entity entities');
  }

}
