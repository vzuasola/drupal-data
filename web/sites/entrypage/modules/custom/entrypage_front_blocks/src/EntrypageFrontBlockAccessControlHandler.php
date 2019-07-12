<?php

namespace Drupal\entrypage_front_blocks;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Entrypage front block entity.
 *
 * @see \Drupal\entrypage_front_blocks\Entity\EntrypageFrontBlock.
 */
class EntrypageFrontBlockAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\entrypage_front_blocks\Entity\EntrypageFrontBlockInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished entrypage front block entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published entrypage front block entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit entrypage front block entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete entrypage front block entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add entrypage front block entities');
  }

}
