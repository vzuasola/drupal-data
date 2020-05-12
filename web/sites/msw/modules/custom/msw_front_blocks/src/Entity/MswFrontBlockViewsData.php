<?php

namespace Drupal\msw_front_blocks\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for msw front block entities.
 */
class MswFrontBlockViewsData extends EntityViewsData {

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
