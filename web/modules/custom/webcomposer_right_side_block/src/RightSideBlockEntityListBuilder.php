<?php

namespace Drupal\webcomposer_right_side_block;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Inner Page Right Side Block entities.
 *
 * @ingroup webcomposer_right_side_block
 */
class RightSideBlockEntityListBuilder extends EntityListBuilder {

  use LinkGeneratorTrait;

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
    /* @var $entity \Drupal\webcomposer_right_side_block\Entity\RightSideBlockEntity */
    $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.right_side_block_entity.edit_form', array(
          'right_side_block_entity' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
