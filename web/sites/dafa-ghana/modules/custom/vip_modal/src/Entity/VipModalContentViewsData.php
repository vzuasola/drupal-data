<?php

namespace Drupal\vip_modal\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Vip Modal Content Entity entities.
 */
class VipModalContentViewsData extends EntityViewsData {

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
