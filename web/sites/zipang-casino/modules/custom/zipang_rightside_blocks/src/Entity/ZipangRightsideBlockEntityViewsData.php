<?php

namespace Drupal\zipang_rightside_blocks\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Zipang rightside block entity entities.
 */
class ZipangRightsideBlockEntityViewsData extends EntityViewsData {

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
