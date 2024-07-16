<?php

namespace Drupal\zipang_new_slider;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Zipang new slider entity entities.
 *
 * @ingroup zipang_new_slider
 */

class ZipangNewSliderEntityListBuilder extends EntityListBuilder {
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
    /* @var $entity \Drupal\zipang_new_slider\Entity\ZipangNewSliderEntity */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.zipang_new_slider_entity.edit_form',
      ['zipang_new_slider_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }
}
