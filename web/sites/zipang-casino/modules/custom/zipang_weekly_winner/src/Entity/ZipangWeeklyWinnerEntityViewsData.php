<?php

namespace Drupal\zipang_weekly_winner\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Zipang weekly winner entity entities.
 */
class ZipangWeeklyWinnerEntityViewsData extends EntityViewsData {

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
