<?php

namespace Drupal\zipang_weekly_winner;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Zipang weekly winner entity entities.
 *
 * @ingroup zipang_weekly_winner
 */
class ZipangWeeklyWinnerEntityListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\zipang_weekly_winner\Entity\ZipangWeeklyWinnerEntity */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.zipang_weekly_winner_entity.edit_form',
      ['zipang_weekly_winner_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
