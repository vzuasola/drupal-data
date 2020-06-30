<?php

namespace Drupal\deposit_and_withdrawal;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Deposit and withdrawal entity entities.
 *
 * @ingroup deposit_and_withdrawal
 */
class DepositAndWithdrawalEntityListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\deposit_and_withdrawal\Entity\DepositAndWithdrawalEntity */
  
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.deposit_and_withdrawal_entity.edit_form',
      ['deposit_and_withdrawal_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
