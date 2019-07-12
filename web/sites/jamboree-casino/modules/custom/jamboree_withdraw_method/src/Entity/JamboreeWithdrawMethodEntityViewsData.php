<?php

namespace Drupal\jamboree_withdraw_method\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Jamboree withdraw method entity entities.
 */
class JamboreeWithdrawMethodEntityViewsData extends EntityViewsData {

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
