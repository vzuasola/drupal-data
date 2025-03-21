<?php

namespace Drupal\webcomposer_sponsor\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Sponsor entities.
 */
class SponsorEntityViewsData extends EntityViewsData {

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
