<?php

namespace Drupal\zipang_news_and_updates\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for News and updates entity entities.
 */
class NewsAndUpdatesEntityViewsData extends EntityViewsData {

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
