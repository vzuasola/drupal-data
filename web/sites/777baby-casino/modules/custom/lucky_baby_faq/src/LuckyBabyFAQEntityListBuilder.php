<?php

namespace Drupal\lucky_baby_faq;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Lucky Baby FAQ Entity entities.
 *
 * @ingroup lucky_baby_faq
 */
class LuckyBabyFAQEntityListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\lucky_baby_faq\Entity\LuckyBabyFAQEntity */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.lucky_baby_f_a_q_entity.edit_form',
      ['lucky_baby_f_a_q_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
