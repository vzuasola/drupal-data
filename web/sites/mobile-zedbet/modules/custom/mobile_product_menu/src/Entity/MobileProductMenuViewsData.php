<?php

namespace Drupal\mobile_product_menu\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Mobile Product Menu entities.
 */
class MobileProductMenuViewsData extends EntityViewsData {

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
