<?php

namespace Drupal\jamboree_content_blocks;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Content block entity entities.
 *
 * @ingroup jamboree_content_blocks
 */
class ContentBlockEntityListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\jamboree_content_blocks\Entity\ContentBlockEntity */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.content_block_entity.edit_form',
      ['content_block_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
