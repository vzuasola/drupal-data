<?php

namespace Drupal\zedbet_front_blocks\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Zedbet front block entities.
 */
class ZedbetFrontBlockViewsData extends EntityViewsData {

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
