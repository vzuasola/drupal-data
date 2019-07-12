<?php

namespace Drupal\zipang_special_promotions_notif;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Zipang special promotions entity entities.
 *
 * @ingroup zipang_special_promotions_notif
 */
class ZipangSpecialPromotionsEntityListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\zipang_special_promotions_notif\Entity\ZipangSpecialPromotionsEntity */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.zipang_special_promotions_entity.edit_form',
      ['zipang_special_promotions_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
