<?php

namespace Drupal\mobile_sponsor_list_v2;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Mobile Sponsor List version 2.0 entity.
 *
 * @see \Drupal\mobile_sponsor_list_v2\Entity\MobileSponsorListv2.
 */
class MobileSponsorListv2AccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\mobile_sponsor_list_v2\Entity\MobileSponsorListv2Interface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished mobile sponsor list version 2.0 entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published mobile sponsor list version 2.0 entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit mobile sponsor list version 2.0 entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete mobile sponsor list version 2.0 entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add mobile sponsor list version 2.0 entities');
  }

}
