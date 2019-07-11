<?php

namespace Drupal\jamboree_big_winner;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Jamboree big winner entity entities.
 *
 * @ingroup jamboree_big_winner
 */
class JamboreeBigWinnerEntityListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\jamboree_big_winner\Entity\JamboreeBigWinnerEntity */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.jamboree_big_winner_entity.edit_form',
      ['jamboree_big_winner_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
