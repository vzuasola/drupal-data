<?php

namespace Drupal\jamboree_desktop_blocks;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Jamboree desktop block entities.
 *
 * @ingroup jamboree_desktop_blocks
 */
class JamboreeDesktopBlockListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\jamboree_desktop_blocks\Entity\JamboreeDesktopBlock */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.jamboree_desktop_block.edit_form',
      ['jamboree_desktop_block' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
