<?php

namespace Drupal\payment_method_list\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Payment Method entity entities.
 */
class PaymentMethodListEntityViewsData extends EntityViewsData {

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
