<?php

namespace Drupal\rightside_block;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Rightside block entity entities.
 *
 * @ingroup rightside_block
 */
class RightsideBlockEntityListBuilder extends EntityListBuilder {


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
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.rightside_block_entity.edit_form',
      ['rightside_block_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
