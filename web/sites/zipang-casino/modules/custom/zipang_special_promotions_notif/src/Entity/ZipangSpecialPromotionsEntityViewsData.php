<?php

namespace Drupal\zipang_special_promotions_notif\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Zipang special promotions entity entities.
 */
class ZipangSpecialPromotionsEntityViewsData extends EntityViewsData {

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
