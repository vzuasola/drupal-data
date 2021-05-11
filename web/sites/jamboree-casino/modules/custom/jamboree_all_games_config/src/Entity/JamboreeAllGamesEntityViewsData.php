<?php

namespace Drupal\jamboree_all_games_config\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Jamboree all games entity entities.
 */
class JamboreeAllGamesEntityViewsData extends EntityViewsData {

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
