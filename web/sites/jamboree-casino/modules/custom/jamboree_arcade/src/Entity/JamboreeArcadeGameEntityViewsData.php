<?php

namespace Drupal\jamboree_arcade\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Jamboree arcade game entity entities.
 */
class JamboreeArcadeGameEntityViewsData extends EntityViewsData {

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
