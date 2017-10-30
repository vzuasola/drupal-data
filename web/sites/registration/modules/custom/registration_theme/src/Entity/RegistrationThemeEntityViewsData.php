<?php

namespace Drupal\registration_theme\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Registration theme entity entities.
 */
class RegistrationThemeEntityViewsData extends EntityViewsData {

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
