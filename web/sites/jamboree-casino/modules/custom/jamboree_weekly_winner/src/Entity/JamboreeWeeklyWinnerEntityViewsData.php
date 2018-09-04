<?php

namespace Drupal\jamboree_weekly_winner\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Jamboree weekly winner entity entities.
 */
class JamboreeWeeklyWinnerEntityViewsData extends EntityViewsData {

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
