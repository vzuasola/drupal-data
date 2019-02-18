<?php

namespace Drupal\jamboree_fair_gaming;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Jamboree fair gaming entity entities.
 *
 * @ingroup jamboree_fair_gaming
 */
class JamboreeFairGamingEntityListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\jamboree_fair_gaming\Entity\JamboreeFairGamingEntity */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.jamboree_fair_gaming_entity.edit_form',
      ['jamboree_fair_gaming_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
