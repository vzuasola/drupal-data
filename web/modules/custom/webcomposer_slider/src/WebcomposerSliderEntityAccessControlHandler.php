<?php

namespace Drupal\webcomposer_slider;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Webcomposer slider entity entity.
 *
 * @see \Drupal\webcomposer_slider\Entity\WebcomposerSliderEntity.
 */
class WebcomposerSliderEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\webcomposer_slider\Entity\WebcomposerSliderEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished webcomposer slider entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published webcomposer slider entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit webcomposer slider entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete webcomposer slider entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add webcomposer slider entity entities');
  }

}
