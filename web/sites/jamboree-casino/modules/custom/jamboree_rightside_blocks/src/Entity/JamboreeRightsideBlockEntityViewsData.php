<?php

namespace Drupal\jamboree_rightside_blocks\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Jamboree rightside block entity entities.
 */
class JamboreeRightsideBlockEntityViewsData extends EntityViewsData {

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
