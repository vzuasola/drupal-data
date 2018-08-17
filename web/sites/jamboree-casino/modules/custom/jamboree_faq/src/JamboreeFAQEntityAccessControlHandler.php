<?php

namespace Drupal\jamboree_faq;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Jamboree FAQ Entity entity.
 *
 * @see \Drupal\jamboree_faq\Entity\JamboreeFAQEntity.
 */
class JamboreeFAQEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\jamboree_faq\Entity\JamboreeFAQEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished jamboree faq entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published jamboree faq entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit jamboree faq entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete jamboree faq entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add jamboree faq entity entities');
  }

}
