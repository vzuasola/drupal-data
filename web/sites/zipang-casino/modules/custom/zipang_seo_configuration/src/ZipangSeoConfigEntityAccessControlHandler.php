<?php

namespace Drupal\zipang_seo_configuration;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Zipang seo config entity entity.
 *
 * @see \Drupal\zipang_seo_configuration\Entity\ZipangSeoConfigEntity.
 */
class ZipangSeoConfigEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\zipang_seo_configuration\Entity\ZipangSeoConfigEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished zipang seo config entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published zipang seo config entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit zipang seo config entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete zipang seo config entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add zipang seo config entity entities');
  }

}
