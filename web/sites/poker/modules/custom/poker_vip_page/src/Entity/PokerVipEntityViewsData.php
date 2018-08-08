<?php

namespace Drupal\poker_vip_page\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Poker vip entity entities.
 */
class PokerVipEntityViewsData extends EntityViewsData {

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
