<?php

namespace Drupal\footer_casino_providers\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Nextbet payment entities.
 */
class FooterCasinoProviderViewsData extends EntityViewsData {

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
