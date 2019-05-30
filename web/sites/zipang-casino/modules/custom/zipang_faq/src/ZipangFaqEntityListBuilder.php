<?php

namespace Drupal\zipang_faq;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Zipang FAQ Entity entities.
 *
 * @ingroup zipang_faq
 */
class ZipangFaqEntityListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\zipang_faq\Entity\ZipangFaqEntity */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.zipang_f_a_q_entity.edit_form',
      ['zipang_f_a_q_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
