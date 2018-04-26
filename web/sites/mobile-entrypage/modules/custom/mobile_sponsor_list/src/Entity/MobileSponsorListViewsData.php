<?php

namespace Drupal\mobile_sponsor_list\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Mobile sponsor list entities.
 */
class MobileSponsorListViewsData extends EntityViewsData {

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
