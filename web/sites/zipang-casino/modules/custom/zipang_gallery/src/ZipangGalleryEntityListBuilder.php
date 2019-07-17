<?php

namespace Drupal\zipang_gallery;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Zipang gallery entity entities.
 *
 * @ingroup zipang_gallery
 */
class ZipangGalleryEntityListBuilder extends EntityListBuilder {

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
    /* @var \Drupal\zipang_gallery\Entity\ZipangGalleryEntity $entity */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.zipang_gallery_entity.edit_form',
      ['zipang_gallery_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
