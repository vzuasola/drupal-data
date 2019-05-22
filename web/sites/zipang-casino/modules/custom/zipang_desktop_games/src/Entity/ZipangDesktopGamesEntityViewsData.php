<?php

namespace Drupal\zipang_desktop_games\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Zipang desktop games entity entities.
 */
class ZipangDesktopGamesEntityViewsData extends EntityViewsData {

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
