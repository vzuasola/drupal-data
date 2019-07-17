<?php

namespace Drupal\zipang_gallery\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Zipang gallery entity entities.
 */
class ZipangGalleryEntityViewsData extends EntityViewsData {

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
