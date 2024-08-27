<?php

namespace Drupal\zipang_game_promotions;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Zipang game promotions entity entities.
 *
 * @ingroup zipang_game_promotions
 */
class ZipangGamePromotionsEntityListBuilder extends EntityListBuilder {
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
    /* @var $entity \Drupal\zipang_game_promotions\Entity\ZipangGamePromotionsEntity */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.zipang_game_promotions_entity.edit_form',
      ['zipang_game_promotions_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }
}
