<?php

namespace Drupal\arcade_collection\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Arcade collection entities.
 */
class ArcadeCollectionViewsData extends EntityViewsData {

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
