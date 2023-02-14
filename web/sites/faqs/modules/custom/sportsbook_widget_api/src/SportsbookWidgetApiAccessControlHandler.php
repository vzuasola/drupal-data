<?php

namespace Drupal\sportsbook_widget_api;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Defines the access control handler for thesportsbook widget api entity type.
 */
class SportsbookWidgetApiAccessControlHandler extends EntityAccessControlHandler
{

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account)
  {

    switch ($operation) {
      case 'view':
        return AccessResult::allowedIfHasPermission($account, 'viewsportsbook widget api');

      case 'update':
        return AccessResult::allowedIfHasPermissions($account, ['editsportsbook widget api', 'administersportsbook widget api'], 'OR');

      case 'delete':
        return AccessResult::allowedIfHasPermissions($account, ['deletesportsbook widget api', 'administersportsbook widget api'], 'OR');

      default:
        // No opinion.
        return AccessResult::neutral();
    }
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL)
  {
    return AccessResult::allowedIfHasPermissions($account, ['createsportsbook widget api', 'administersportsbook widget api'], 'OR');
  }
}
