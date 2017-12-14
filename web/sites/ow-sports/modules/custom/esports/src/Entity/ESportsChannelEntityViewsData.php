<?php

namespace Drupal\esports\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Esports channel entity entities.
 */
class ESportsChannelEntityViewsData extends EntityViewsData {

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
