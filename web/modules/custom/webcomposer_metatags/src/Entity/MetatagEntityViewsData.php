<?php

namespace Drupal\webcomposer_metatags\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Metatag entity entities.
 */
class MetatagEntityViewsData extends EntityViewsData {

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
