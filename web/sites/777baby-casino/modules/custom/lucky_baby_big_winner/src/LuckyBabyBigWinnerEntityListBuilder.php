<?php

namespace Drupal\lucky_baby_big_winner;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Lucky baby big winner entity entities.
 *
 * @ingroup lucky_baby_big_winner
 */
class LuckyBabyBigWinnerEntityListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Lucky baby big winner entity ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\lucky_baby_big_winner\Entity\LuckyBabyBigWinnerEntity */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.lucky_baby_big_winner_entity.edit_form',
      ['lucky_baby_big_winner_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
