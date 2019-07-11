<?php

namespace Drupal\zipang_press\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Zipang press entity entities.
 */
class ZipangPressEntityViewsData extends EntityViewsData {

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
