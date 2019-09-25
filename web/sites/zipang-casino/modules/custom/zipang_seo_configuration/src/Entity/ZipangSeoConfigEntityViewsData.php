<?php

namespace Drupal\zipang_seo_configuration\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Zipang seo config entity entities.
 */
class ZipangSeoConfigEntityViewsData extends EntityViewsData {

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
