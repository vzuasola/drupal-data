<?php

namespace Drupal\client_footer_games\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Client footer games entities.
 */
class ClientFooterGamesViewsData extends EntityViewsData {

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
