<?php

namespace Drupal\zipang_faq\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Zipang faq entity entities.
 */
class ZipangFaqEntityViewsData extends EntityViewsData {

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
