<?php

namespace Drupal\ghana_quick_links\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Quick links entity entities.
 */
class QuickLinksEntityViewsData extends EntityViewsData {

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
