<?php

namespace Drupal\zipang_big_winner\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Zipang big winner entity entities.
 */
class ZipangBigWinnerEntityViewsData extends EntityViewsData {

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
