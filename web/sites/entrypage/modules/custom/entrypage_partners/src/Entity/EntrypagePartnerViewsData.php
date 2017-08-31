<?php

namespace Drupal\entrypage_partners\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Entrypage partner entities.
 */
class EntrypagePartnerViewsData extends EntityViewsData {

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
