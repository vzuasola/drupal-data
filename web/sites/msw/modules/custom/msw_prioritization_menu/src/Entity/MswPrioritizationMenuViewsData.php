<?php

namespace Drupal\msw_prioritization_menu\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Video Call Prioritization Menu entities.
 */
class MswPrioritizationMenuViewsData extends EntityViewsData {

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
