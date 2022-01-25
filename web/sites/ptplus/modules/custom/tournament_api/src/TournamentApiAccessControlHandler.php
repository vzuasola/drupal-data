<?php

namespace Drupal\tournament_api;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for theTournament Api entity.
 *
 * @see \Drupal\tournament_api\Entity\TournamentApi.
 */
class TournamentApiAccessControlHandler extends EntityAccessControlHandler
{
  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account)
  {
    /** @var \Drupal\tournament_api\Entity\TournamentApiInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublishedTournament Api entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view publishedTournament Api entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'editTournament Api entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'deleteTournament Api entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL)
  {
    return AccessResult::allowedIfHasPermission($account, 'addTournament Api entities');
  }
}
