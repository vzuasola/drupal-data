<?php

namespace Drupal\mobile_marketing_space\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Mobile marketing space entities.
 */
class MobileMarketingSpaceViewsData extends EntityViewsData {

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
