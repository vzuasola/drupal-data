<?php

namespace Drupal\webcomposer_slider\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Web Composer Slider entities.
 */
class WebComposerSliderViewsData extends EntityViewsData {

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
