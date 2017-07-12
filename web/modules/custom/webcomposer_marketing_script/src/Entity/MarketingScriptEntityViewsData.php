<?php

namespace Drupal\webcomposer_marketing_script\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Marketing Script entities.
 */
class MarketingScriptEntityViewsData extends EntityViewsData {

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
