<?php

namespace Drupal\webcomposer_download_page\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Webcomposer download page entities.
 */
class WebcomposerDownloadPageViewsData extends EntityViewsData {

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
