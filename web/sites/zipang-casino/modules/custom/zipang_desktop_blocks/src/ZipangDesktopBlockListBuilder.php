<?php

namespace Drupal\zipang_desktop_blocks;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Zipang desktop block entities.
 *
 * @ingroup zipang_desktop_blocks
 */
class ZipangDesktopBlockListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\zipang_desktop_blocks\Entity\ZipangDesktopBlock */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.zipang_desktop_block.edit_form',
      ['zipang_desktop_block' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
