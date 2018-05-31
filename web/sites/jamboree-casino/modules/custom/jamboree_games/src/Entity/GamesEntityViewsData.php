<?php

namespace Drupal\jamboree_games\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Games entity entities.
 */
class GamesEntityViewsData extends EntityViewsData {

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
