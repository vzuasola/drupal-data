<?php

namespace Drupal\zipang_rightside_blocks;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Zipang rightside block entity entities.
 *
 * @ingroup zipang_rightside_blocks
 */
class ZipangRightsideBlockEntityListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\zipang_rightside_blocks\Entity\ZipangRightsideBlockEntity */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.zipang_rightside_block_entity.edit_form',
      ['zipang_rightside_block_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
