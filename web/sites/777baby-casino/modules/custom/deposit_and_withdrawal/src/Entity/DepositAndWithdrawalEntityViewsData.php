<?php

namespace Drupal\deposit_and_withdrawal\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Deposit and withdrawal entity entities.
 */
class DepositAndWithdrawalEntityViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.

    return $data;
  }

}
