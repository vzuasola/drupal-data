<?php

namespace Drupal\custom_inner_pages\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for How to play entities.
 */
class HowToPlayViewsData extends EntityViewsData {

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
