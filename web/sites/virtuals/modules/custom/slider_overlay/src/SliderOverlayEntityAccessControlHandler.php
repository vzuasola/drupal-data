<?php

namespace Drupal\slider_overlay;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Slider Overlay entity.
 *
 * @see \Drupal\slider_overlay\Entity\SliderOverlayEntity.
 */
class SliderOverlayEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\slider_overlay\Entity\SliderOverlayEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished slider overlay entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published slider overlay entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit slider overlay entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete slider overlay entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add slider overlay entities');
  }

}
