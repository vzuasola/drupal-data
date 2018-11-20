<?php

namespace Drupal\download_page\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Download page entity entities.
 */
class DownloadPageEntityViewsData extends EntityViewsData {

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
