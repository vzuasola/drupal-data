<?php

namespace Drupal\webcomposer_floating_banners\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Left floating banner entity entities.
 */
class LeftFloatingBannerEntityViewsData extends EntityViewsData {

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
