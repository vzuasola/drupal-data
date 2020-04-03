<?php

namespace Drupal\mobile_sponsor_list;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Mobile sponsor list entity.
 *
 * @see \Drupal\mobile_sponsor_list\Entity\MobileSponsorList.
 */
class MobileSponsorListAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\mobile_sponsor_list\Entity\MobileSponsorListInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished mobile sponsor list entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published mobile sponsor list entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit mobile sponsor list entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete mobile sponsor list entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add mobile sponsor list entities');
  }

}
