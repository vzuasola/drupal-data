<?php

namespace Drupal\lucky_baby_all_games_config\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Lucky Baby all games entity entities.
 */
class LuckyBabyAllGamesEntityViewsData extends EntityViewsData {

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
