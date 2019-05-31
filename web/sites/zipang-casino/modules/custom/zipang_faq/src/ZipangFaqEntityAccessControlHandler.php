<?php

namespace Drupal\zipang_faq;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Zipang FAQ Entity entity.
 *
 * @see \Drupal\zipang_faq\Entity\ZipangFaqEntity.
 */
class ZipangFaqEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\zipang_faq\Entity\ZipangFaqEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished zipang faq entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published zipang faq entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit zipang faq entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete zipang faq entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add zipang faq entity entities');
  }

}
