<?php

namespace Drupal\jamboree_desktop_games\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Jamboree desktop games entity entities.
 */
class JamboreeDesktopGamesEntityViewsData extends EntityViewsData {

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
