<?php

namespace Drupal\lucky_baby_404;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Lucky Baby 404 Image Entity entities.
 *
 * @ingroup lucky_baby_404
 */
class LuckyBaby404ImageEntityListBuilder extends EntityListBuilder {


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
      'entity.lucky_baby404_image_entity.edit_form',
      ['lucky_baby404_image_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
