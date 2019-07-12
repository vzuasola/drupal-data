<?php

namespace Drupal\jamboree_weekly_winner;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Jamboree weekly winner entity entities.
 *
 * @ingroup jamboree_weekly_winner
 */
class JamboreeWeeklyWinnerEntityListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\jamboree_weekly_winner\Entity\JamboreeWeeklyWinnerEntity */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.jamboree_weekly_winner_entity.edit_form',
      ['jamboree_weekly_winner_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
