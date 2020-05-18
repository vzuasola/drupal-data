<?php

namespace Drupal\nextbet_front_blocks\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Nextbet front block entities.
 */
class NextbetFrontBlockViewsData extends EntityViewsData {

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
