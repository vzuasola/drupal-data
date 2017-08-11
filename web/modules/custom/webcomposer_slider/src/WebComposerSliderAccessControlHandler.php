<?php

namespace Drupal\webcomposer_slider;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Web Composer Slider entity.
 *
 * @see \Drupal\webcomposer_slider\Entity\WebComposerSlider.
 */
class WebComposerSliderAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\webcomposer_slider\Entity\WebComposerSliderInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished web composer slider entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published web composer slider entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit web composer slider entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete web composer slider entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add web composer slider entities');
  }

}
