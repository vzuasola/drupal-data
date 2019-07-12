<?php

namespace Drupal\jamboree_big_winner\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Jamboree big winner entity entities.
 */
class JamboreeBigWinnerEntityViewsData extends EntityViewsData {

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
