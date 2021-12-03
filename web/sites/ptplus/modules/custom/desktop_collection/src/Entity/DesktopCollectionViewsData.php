<?php

namespace Drupal\desktop_collection\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Desktop collection entities.
 */
class DesktopCollectionViewsData extends EntityViewsData {
  
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
