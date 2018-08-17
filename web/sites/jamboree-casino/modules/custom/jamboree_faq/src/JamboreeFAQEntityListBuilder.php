<?php

namespace Drupal\jamboree_faq;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Jamboree FAQ Entity entities.
 *
 * @ingroup jamboree_faq
 */
class JamboreeFAQEntityListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\jamboree_faq\Entity\JamboreeFAQEntity */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.jamboree_f_a_q_entity.edit_form',
      ['jamboree_f_a_q_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
