<?php

namespace Drupal\lucky_baby_jackpot;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Jackpot entity entities.
 *
 * @ingroup lucky_baby_jackpot
 */
class JackpotEntityListBuilder extends EntityListBuilder {


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
      'entity.jackpot_entity.edit_form',
      ['jackpot_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
