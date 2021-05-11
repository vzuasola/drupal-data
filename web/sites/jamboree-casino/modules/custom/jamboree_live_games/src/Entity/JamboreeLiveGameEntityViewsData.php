<?php

namespace Drupal\jamboree_live_games\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Jamboree live game entity entities.
 */
class JamboreeLiveGameEntityViewsData extends EntityViewsData {

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
