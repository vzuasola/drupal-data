<?php

namespace Drupal\webcomposer_partner_responsive\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Partner entities.
 */
class PartnerResponsiveEntityViewsData extends EntityViewsData {

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    $data = parent::getViewsData();

    // Additional information for Views integration, such as table joins,
    // can be put here.
    return $data;
  }

}
