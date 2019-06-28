<?php

namespace Drupal\zipang_promotions\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Zipang promotions entity entities.
 */
class ZipangPromotionsEntityViewsData extends EntityViewsData {

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
