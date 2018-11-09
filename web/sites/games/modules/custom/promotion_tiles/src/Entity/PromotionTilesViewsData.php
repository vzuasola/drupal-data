<?php

namespace Drupal\promotion_tiles\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Promotion tiles entities.
 */
class PromotionTilesViewsData extends EntityViewsData {

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
