<?php

namespace Drupal\jamboree_jackpot;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Jamboree jackpot entity entities.
 *
 * @ingroup jamboree_jackpot
 */
class JamboreeJackpotEntityListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\jamboree_jackpot\Entity\JamboreeJackpotEntity */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.jamboree_jackpot_entity.edit_form',
      ['jamboree_jackpot_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
