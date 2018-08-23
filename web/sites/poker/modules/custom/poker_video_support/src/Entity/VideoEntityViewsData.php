<?php

namespace Drupal\poker_video_support\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Video entity entities.
 */
class VideoEntityViewsData extends EntityViewsData {

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
