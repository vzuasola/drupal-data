<?php

namespace Drupal\entrypage_partners;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Entrypage partner entity.
 *
 * @see \Drupal\entrypage_partners\Entity\EntrypagePartner.
 */
class EntrypagePartnerAccessControlHandler extends EntityAccessControlHandler
{

  /**
   * {@inheritdoc}
   */
    protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account)
    {
        /** @var \Drupal\entrypage_partners\Entity\EntrypagePartnerInterface $entity */
        switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
            return AccessResult::allowedIfHasPermission($account, 'view unpublished entrypage partner entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published entrypage partner entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit entrypage partner entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete entrypage partner entities');
    }

        // Unknown operation, no opinion.
        return AccessResult::neutral();
    }

    /**
     * {@inheritdoc}
     */
    protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = null)
    {
        return AccessResult::allowedIfHasPermission($account, 'add entrypage partner entities');
    }
}
