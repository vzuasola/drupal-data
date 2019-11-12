<?php

namespace Drupal\lucky_baby_desktop_block;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Lucky baby desktop block entity entities.
 *
 * @ingroup lucky_baby_desktop_block
 */
class LuckyBabyDesktopBlockEntityListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\lucky_baby_desktop_block\Entity\LuckyBabyDesktopBlockEntity */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.lucky_baby_desktop_block_entity.edit_form',
      ['lucky_baby_desktop_block_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
