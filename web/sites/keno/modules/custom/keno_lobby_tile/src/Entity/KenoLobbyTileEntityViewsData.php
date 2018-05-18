<?php

namespace Drupal\keno_lobby_tile\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Keno lobby tile entity entities.
 */
class KenoLobbyTileEntityViewsData extends EntityViewsData {

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
