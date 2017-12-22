<?php

namespace Drupal\webcomposer_slider_v2\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Webcomposer slider 2.0 entity entities.
 */
class WebcomposerSliderV2EntityViewsData extends EntityViewsData {

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
