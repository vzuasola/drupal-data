<?php

namespace Drupal\desktop_slider;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for theDesktop slider entity.
 *
 * @see \Drupal\desktop_slider\Entity\DesktopSlider.
 */
class DesktopSliderAccessControlHandler extends EntityAccessControlHandler
{
  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account)
  {
    /** @var \Drupal\desktop_slider\Entity\DesktopSliderInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublisheddesktop slider entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view publisheddesktop slider entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'editdesktop slider entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'deletedesktop slider entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL)
  {
    return AccessResult::allowedIfHasPermission($account, 'adddesktop slider entities');
  }
}
