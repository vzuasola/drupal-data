<?php

namespace Drupal\zipang_mobile_blocks;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Zipang mobile block entity entities.
 *
 * @ingroup zipang_mobile_blocks
 */
class ZipangMobileBlockEntityListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\zipang_mobile_blocks\Entity\ZipangMobileBlockEntity */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.zipang_mobile_block_entity.edit_form',
      ['zipang_mobile_block_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
