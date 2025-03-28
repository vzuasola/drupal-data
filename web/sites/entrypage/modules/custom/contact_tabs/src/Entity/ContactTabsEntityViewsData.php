<?php

namespace Drupal\contact_tabs\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Contact tabs entity entities.
 */
class ContactTabsEntityViewsData extends EntityViewsData {

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
