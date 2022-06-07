<?php

namespace Drupal\zedbet_payments\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Zedbet payment entities.
 */
class ZedbetPaymentViewsData extends EntityViewsData {

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
