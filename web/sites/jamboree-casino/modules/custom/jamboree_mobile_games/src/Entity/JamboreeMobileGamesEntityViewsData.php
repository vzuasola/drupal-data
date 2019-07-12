<?php

namespace Drupal\jamboree_mobile_games\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Jamboree mobile games entity entities.
 */
class JamboreeMobileGamesEntityViewsData extends EntityViewsData {

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
