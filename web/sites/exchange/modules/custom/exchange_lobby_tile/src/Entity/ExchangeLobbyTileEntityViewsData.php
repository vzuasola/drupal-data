<?php

namespace Drupal\exchange_lobby_tile\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for exchange lobby tile entity entities.
 */
class ExchangeLobbyTileEntityViewsData extends EntityViewsData {

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
