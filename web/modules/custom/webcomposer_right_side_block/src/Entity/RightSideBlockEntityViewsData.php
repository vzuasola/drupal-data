<?php

namespace Drupal\webcomposer_right_side_block\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Inner Page Right Side Block entities.
 */
class RightSideBlockEntityViewsData extends EntityViewsData {

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
