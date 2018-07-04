<?php

namespace Drupal\jamboree_mobile_blocks;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Jamboree mobile block entity entities.
 *
 * @ingroup jamboree_mobile_blocks
 */
class JamboreeMobileBlockEntityListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\jamboree_mobile_blocks\Entity\JamboreeMobileBlockEntity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.jamboree_mobile_block_entity.edit_form',
      ['jamboree_mobile_block_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
