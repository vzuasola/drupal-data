<?php

namespace Drupal\zipang_mobile_games\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Zipang mobile games entity entities.
 */
class ZipangMobileGamesEntityViewsData extends EntityViewsData {

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
