<?php

namespace Drupal\jamboree_dropdown_menu\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Dropdown menu entity entities.
 */
class DropdownMenuEntityViewsData extends EntityViewsData {

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
