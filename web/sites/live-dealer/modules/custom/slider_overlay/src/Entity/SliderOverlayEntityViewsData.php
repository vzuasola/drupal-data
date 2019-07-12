<?php

namespace Drupal\slider_overlay\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Slider Overlay entities.
 */
class SliderOverlayEntityViewsData extends EntityViewsData {

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
