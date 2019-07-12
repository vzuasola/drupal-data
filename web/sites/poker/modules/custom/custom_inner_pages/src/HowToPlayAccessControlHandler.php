<?php

namespace Drupal\custom_inner_pages;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the How to play entity.
 *
 * @see \Drupal\custom_inner_pages\Entity\HowToPlay.
 */
class HowToPlayAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\custom_inner_pages\Entity\HowToPlayInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished how to play entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published how to play entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit how to play entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete how to play entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add how to play entities');
  }

}
