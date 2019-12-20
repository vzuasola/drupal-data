<?php

namespace Drupal\mobile_sponsor_list_v2\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Default entity entities.
 */
class MobileSponsorListv2ViewsData extends EntityViewsData {

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
