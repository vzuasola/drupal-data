<?php

namespace Drupal\lucky_baby_fair_gaming;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Lucky baby fair gaming entity entities.
 *
 * @ingroup lucky_baby_fair_gaming
 */
class LuckyBabyFairGamingEntityListBuilder extends EntityListBuilder {


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
      'entity.lucky_baby_fair_gaming_entity.edit_form',
      ['lucky_baby_fair_gaming_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
