<?php

namespace Drupal\jamboree_faq\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Jamboree FAQ Entity entities.
 */
class JamboreeFAQEntityViewsData extends EntityViewsData {

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
