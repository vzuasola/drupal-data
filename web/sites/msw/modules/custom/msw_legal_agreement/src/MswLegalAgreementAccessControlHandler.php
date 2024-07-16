<?php

namespace Drupal\msw_legal_agreement;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Access controller for the Registration Legal Agreement entity.
 *
 * @see \Drupal\msw_legal_agreement\Entity\MswLegalAgreement.
 */
class MswLegalAgreementAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    /** @var \Drupal\msw_legal_agreement\Entity\MswLegalAgreementInterface $entity */
    switch ($operation) {
      case 'view':
        if (!$entity->isPublished()) {
          return AccessResult::allowedIfHasPermission($account, 'view unpublished msw legal agreement entities');
        }
        return AccessResult::allowedIfHasPermission($account, 'view published msw legal agreement entities');

      case 'update':
        return AccessResult::allowedIfHasPermission($account, 'edit msw legal agreement entities');

      case 'delete':
        return AccessResult::allowedIfHasPermission($account, 'delete msw legal agreement entities');
    }

    // Unknown operation, no opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add msw legal agreement entities');
  }

}
