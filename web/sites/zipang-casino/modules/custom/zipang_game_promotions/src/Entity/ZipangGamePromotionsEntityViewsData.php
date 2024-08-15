<?php

namespace Drupal\zipang_game_promotions\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Zipang game promotions entity entities.
 */
class ZipangGamePromotionsEntityViewsData extends EntityViewsData{

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
