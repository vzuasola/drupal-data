<?php

namespace Drupal\zipang_promotions;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Zipang promotions entity entities.
 *
 * @ingroup zipang_promotions
 */
class ZipangPromotionsEntityListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\zipang_promotions\Entity\ZipangPromotionsEntity */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.zipang_promotions_entity.edit_form',
      ['zipang_promotions_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
