<?php

namespace Drupal\jamboree_jackpot\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Jamboree jackpot entity entities.
 */
class JamboreeJackpotEntityViewsData extends EntityViewsData {

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
