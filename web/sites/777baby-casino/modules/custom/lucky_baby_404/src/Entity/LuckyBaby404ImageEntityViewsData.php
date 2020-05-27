<?php

namespace Drupal\lucky_baby_404\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Lucky Baby 404 Image Entity entities.
 */
class LuckyBaby404ImageEntityViewsData extends EntityViewsData {

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
