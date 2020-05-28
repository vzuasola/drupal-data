<?php

namespace Drupal\lucky_baby_promotions\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Lucky baby promotions entity entities.
 */
class LuckyBabyPromotionsEntityViewsData extends EntityViewsData {

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
