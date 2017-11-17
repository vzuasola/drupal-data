<?php

namespace Drupal\games_showcase\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Games Showcase entity entities.
 */
class GamesShowcaseEntityViewsData extends EntityViewsData {

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
