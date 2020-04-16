<?php

namespace Drupal\lucky_baby_weekly_winner\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Lucky baby weekly winner entity entities.
 */
class LuckyBabyWeeklyWinnerEntityViewsData extends EntityViewsData {

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
