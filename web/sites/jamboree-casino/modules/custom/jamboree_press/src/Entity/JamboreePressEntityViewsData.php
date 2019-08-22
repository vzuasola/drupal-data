<?php

namespace Drupal\jamboree_press\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Jamboree press entity entities.
 */
class JamboreePressEntityViewsData extends EntityViewsData {

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
