<?php

namespace Drupal\desktop_game_collection\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data forDesktop game collection entities.
 */
class DesktopGameCollectionViewsData extends EntityViewsData {

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
