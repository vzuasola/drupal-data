<?php

namespace Drupal\webcomposer_metatags;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Metatag entity entity.
 *
 * @see \Drupal\webcomposer_metatags\Entity\MetatagEntity.
 */
class MetatagEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\webcomposer_metatags\Entity\MetatagEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished metatag entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published metatag entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit metatag entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete metatag entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add metatag entity entities');
  }

}
