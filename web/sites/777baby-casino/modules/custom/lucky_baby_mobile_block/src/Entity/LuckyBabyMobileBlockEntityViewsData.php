<?php

namespace Drupal\lucky_baby_mobile_block\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Lucky baby mobile block entity entities.
 */
class LuckyBabyMobileBlockEntityViewsData extends EntityViewsData {

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
