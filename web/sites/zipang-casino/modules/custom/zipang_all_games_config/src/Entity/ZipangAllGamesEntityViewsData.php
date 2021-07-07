<?php

namespace Drupal\zipang_all_games_config\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Zipang all games entity entities.
 */
class ZipangAllGamesEntityViewsData extends EntityViewsData {

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
