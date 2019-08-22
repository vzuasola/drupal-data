<?php

namespace Drupal\mobilehub;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Mobile tiles entities.
 *
 * @ingroup mobilehub
 */
class MobileTilesListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Mobile tiles ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\mobilehub\Entity\MobileTiles */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.mobile_tiles.edit_form',
      ['mobile_tiles' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
