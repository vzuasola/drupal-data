<?php

namespace Drupal\desktop_slider\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data forDesktop slider entities.
 */
class DesktopSliderViewsData extends EntityViewsData
{
  /**
   * {@inheritdoc}
   */
  public function getViewsData()
  {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins, can be
    // put here.

    return $data;
  }
}
