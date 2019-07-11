<?php

namespace Drupal\promotion_tiles;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Promotion tiles entities.
 *
 * @ingroup promotion_tiles
 */
class PromotionTilesListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Promotion tiles ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\promotion_tiles\Entity\PromotionTiles */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.promotion_tiles.edit_form',
      ['promotion_tiles' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
