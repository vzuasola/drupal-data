<?php

namespace Drupal\zipang_mobile_blocks\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Zipang mobile block entity entities.
 */
class ZipangMobileBlockEntityViewsData extends EntityViewsData {

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
