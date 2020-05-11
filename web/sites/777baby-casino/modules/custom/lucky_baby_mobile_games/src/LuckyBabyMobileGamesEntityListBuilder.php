<?php

namespace Drupal\lucky_baby_mobile_games;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Lucky baby mobile games entity entities.
 *
 * @ingroup lucky_baby_mobile_games
 */
class LuckyBabyMobileGamesEntityListBuilder extends EntityListBuilder {


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
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.lucky_baby_mobile_games_entity.edit_form',
      ['lucky_baby_mobile_games_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
