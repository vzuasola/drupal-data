<?php

namespace Drupal\webcomposer_social_media;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Social Media entity.
 *
 * @see \Drupal\webcomposer_social_media\Entity\SocialMediaEntity.
 */
class SocialMediaEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\webcomposer_social_media\Entity\SocialMediaEntityInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished social media entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published social media entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit social media entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete social media entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add social media entities');
  }

}
