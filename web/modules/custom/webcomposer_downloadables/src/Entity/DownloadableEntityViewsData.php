<?php

namespace Drupal\webcomposer_downloadables\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Downloadable entity entities.
 */
class DownloadableEntityViewsData extends EntityViewsData {

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
