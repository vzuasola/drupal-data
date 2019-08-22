<?php

namespace Drupal\jamboree_press;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Jamboree press entity entities.
 *
 * @ingroup jamboree_press
 */
class JamboreePressEntityListBuilder extends EntityListBuilder {


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
      'entity.jamboree_press_entity.edit_form',
      ['jamboree_press_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
