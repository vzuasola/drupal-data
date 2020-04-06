<?php

namespace Drupal\mobile_infobar\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Mobile info bar entities.
 */
class MobileInfoBarViewsData extends EntityViewsData {

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
