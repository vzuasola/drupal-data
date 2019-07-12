<?php

namespace Drupal\zipang_404;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Zipang 404 Image Entity entities.
 *
 * @ingroup zipang_404
 */
class Zipang404ImageEntityListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['name'] = $this->t('image');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\zipang_404\Entity\Zipang404ImageEntity */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.zipang_404_image_entity.edit_form',
      ['zipang_404_image_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
