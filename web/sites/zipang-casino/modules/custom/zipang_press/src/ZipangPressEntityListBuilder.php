<?php

namespace Drupal\zipang_press;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Zipang press entity entities.
 *
 * @ingroup zipang_press
 */
class ZipangPressEntityListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\zipang_press\Entity\ZipangPressEntity */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.zipang_press_entity.edit_form',
      ['zipang_press_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
