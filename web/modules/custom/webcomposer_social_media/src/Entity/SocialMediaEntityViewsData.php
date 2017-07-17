<?php

namespace Drupal\webcomposer_social_media\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Social Media entities.
 */
class SocialMediaEntityViewsData extends EntityViewsData {

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
