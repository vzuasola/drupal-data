<?php

namespace Drupal\lucky_baby_desktop_games\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Lucky baby desktop games entity entities.
 */
class LuckyBabyDesktopGamesEntityViewsData extends EntityViewsData {

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
