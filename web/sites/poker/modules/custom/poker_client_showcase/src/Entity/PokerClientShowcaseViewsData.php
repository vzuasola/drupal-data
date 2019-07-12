<?php

namespace Drupal\poker_client_showcase\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Poker client showcase entities.
 */
class PokerClientShowcaseViewsData extends EntityViewsData {

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
