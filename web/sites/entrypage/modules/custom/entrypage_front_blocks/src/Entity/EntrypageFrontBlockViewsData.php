<?php

namespace Drupal\entrypage_front_blocks\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Entrypage front block entities.
 */
class EntrypageFrontBlockViewsData extends EntityViewsData {

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
