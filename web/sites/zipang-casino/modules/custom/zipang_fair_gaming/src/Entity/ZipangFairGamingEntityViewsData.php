<?php

namespace Drupal\zipang_fair_gaming\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Zipang fair gaming entity entities.
 */
class ZipangFairGamingEntityViewsData extends EntityViewsData {

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
