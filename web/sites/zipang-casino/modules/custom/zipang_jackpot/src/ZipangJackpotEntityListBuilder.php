<?php

namespace Drupal\zipang_jackpot;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Zipang jackpot entity entities.
 *
 * @ingroup zipang_jackpot
 */
class ZipangJackpotEntityListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\zipang_jackpot\Entity\ZipangJackpotEntity */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.zipang_jackpot_entity.edit_form',
      ['zipang_jackpot_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
