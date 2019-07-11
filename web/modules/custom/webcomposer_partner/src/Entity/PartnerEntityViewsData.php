<?php

namespace Drupal\webcomposer_partner\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Partner entity entities.
 */
class PartnerEntityViewsData extends EntityViewsData {

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
