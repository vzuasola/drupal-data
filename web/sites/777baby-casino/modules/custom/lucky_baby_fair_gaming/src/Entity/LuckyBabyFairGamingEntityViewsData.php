<?php

namespace Drupal\lucky_baby_fair_gaming\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Lucky baby fair gaming entity entities.
 */
class LuckyBabyFairGamingEntityViewsData extends EntityViewsData {

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
