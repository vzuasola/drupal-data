<?php

namespace Drupal\games_page_background\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Games Page Background entities.
 */
class GamesPageBgEntityViewsData extends EntityViewsData {

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
