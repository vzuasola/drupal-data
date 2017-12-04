<?php

namespace Drupal\slider_overlay;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Slider Overlay entities.
 *
 * @ingroup slider_overlay
 */
class SliderOverlayEntityListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\slider_overlay\Entity\SliderOverlayEntity */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.slider_overlay_entity.edit_form',
      ['slider_overlay_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}