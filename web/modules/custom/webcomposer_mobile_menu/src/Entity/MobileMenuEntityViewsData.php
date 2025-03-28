<?php

namespace Drupal\webcomposer_mobile_menu\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Mobile menu entity entities.
 */
class MobileMenuEntityViewsData extends EntityViewsData {

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
