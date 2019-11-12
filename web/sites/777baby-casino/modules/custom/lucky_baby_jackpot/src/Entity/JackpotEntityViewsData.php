<?php

namespace Drupal\lucky_baby_jackpot\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Jackpot entity entities.
 */
class JackpotEntityViewsData extends EntityViewsData {

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
