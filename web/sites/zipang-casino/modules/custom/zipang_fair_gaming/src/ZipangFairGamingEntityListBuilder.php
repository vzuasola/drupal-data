<?php

namespace Drupal\zipang_fair_gaming;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Zipang fair gaming entity entities.
 *
 * @ingroup zipang_fair_gaming
 */
class ZipangFairGamingEntityListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\zipang_fair_gaming\Entity\ZipangFairGamingEntity */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.zipang_fair_gaming_entity.edit_form',
      ['zipang_fair_gaming_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
