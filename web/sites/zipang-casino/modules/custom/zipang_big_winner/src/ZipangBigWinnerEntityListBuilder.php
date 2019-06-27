<?php

namespace Drupal\zipang_big_winner;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Zipang big winner entity entities.
 *
 * @ingroup zipang_big_winner
 */
class ZipangBigWinnerEntityListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\zipang_big_winner\Entity\ZipangBigWinnerEntity */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.zipang_big_winner_entity.edit_form',
      ['zipang_big_winner_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
