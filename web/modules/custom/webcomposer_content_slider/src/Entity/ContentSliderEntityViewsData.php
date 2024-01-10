<?php

namespace Drupal\webcomposer_content_slider\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Content Slider entity entities.
 */
class ContentSliderEntityViewsData extends EntityViewsData {

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
