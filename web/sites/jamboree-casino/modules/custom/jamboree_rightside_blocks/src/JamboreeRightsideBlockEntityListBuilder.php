<?php

namespace Drupal\jamboree_rightside_blocks;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Jamboree rightside block entity entities.
 *
 * @ingroup jamboree_rightside_blocks
 */
class JamboreeRightsideBlockEntityListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\jamboree_rightside_blocks\Entity\JamboreeRightsideBlockEntity */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.jamboree_rightside_block_entity.edit_form',
      ['jamboree_rightside_block_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
