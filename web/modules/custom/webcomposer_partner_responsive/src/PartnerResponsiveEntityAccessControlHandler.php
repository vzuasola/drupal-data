<?php

namespace Drupal\webcomposer_partner_responsive;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Partner entity.
 *
 * @see \Drupal\webcomposer_partner_responsive\Entity\PartnerResponsiveEntity.
 */
class PartnerResponsiveEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\webcomposer_partner_responsive\Entity\PartnerResponsiveEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished partner - responsive entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published partner - responsive entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit partner - responsive entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete partner - responsive entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add partner - responsive entities');
  }

}
