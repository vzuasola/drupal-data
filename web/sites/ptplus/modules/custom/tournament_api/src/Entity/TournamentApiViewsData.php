<?php

namespace Drupal\tournament_api\Entity;

use Drupal\views\EntityViewsData;

/**
 * Provides Views data for Tournament Api entities.
 */
class TournamentApiViewsData extends EntityViewsData
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
