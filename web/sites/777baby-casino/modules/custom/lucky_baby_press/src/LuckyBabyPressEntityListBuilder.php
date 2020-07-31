<?php

namespace Drupal\lucky_baby_press;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Lucky baby press entity entities.
 *
 * @ingroup lucky_baby_press
 */
class LuckyBabyPressEntityListBuilder extends EntityListBuilder {

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
    /* @var $entity \Drupal\lucky_baby_press\Entity\LuckyBabyPressEntity */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.lucky_baby_press_entity.edit_form',
      ['lucky_baby_press_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
