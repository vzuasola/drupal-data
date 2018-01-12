<?php

namespace Drupal\games_page_background\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Game Page Background entities.
 */
class GamePageBackgroundViewsData extends EntityViewsData {

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
