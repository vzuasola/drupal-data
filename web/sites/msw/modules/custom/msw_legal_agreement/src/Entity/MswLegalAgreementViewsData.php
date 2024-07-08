<?php

namespace Drupal\msw_legal_agreement\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Registration Legal Agreement entities.
 */
class MswLegalAgreementViewsData extends EntityViewsData {

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
