<?php

namespace Drupal\webcomposer_seo;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Webcomposer meta entity entity.
 *
 * @see \Drupal\webcomposer_seo\Entity\WebcomposerMetaEntity.
 */
class WebcomposerMetaEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\webcomposer_seo\Entity\WebcomposerMetaEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished webcomposer meta entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published webcomposer meta entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit webcomposer meta entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete webcomposer meta entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add webcomposer meta entity entities');
  }

}
