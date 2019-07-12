<?php

namespace Drupal\webcomposer_seo\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Webcomposer meta entity entities.
 */
class WebcomposerMetaEntityViewsData extends EntityViewsData {

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
