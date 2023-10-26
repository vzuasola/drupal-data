<?php

namespace Drupal\webcomposer_content_slider;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Webcomposer slider entity entity.
 *
 * @see \Drupal\webcomposer_content_slider\Entity\ContentSliderEntity.
 */
class ContentSliderEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\webcomposer_content_slider\Entity\ContentSliderEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished content slider entity entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published content slider entity entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit content slider entity entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete content slider entity entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add content slider entity entities');
  }

}
