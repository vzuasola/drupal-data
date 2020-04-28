<?php

namespace Drupal\lucky_baby_big_winner\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Lucky baby big winner entity entities.
 */
class LuckyBabyBigWinnerEntityViewsData extends EntityViewsData {

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
