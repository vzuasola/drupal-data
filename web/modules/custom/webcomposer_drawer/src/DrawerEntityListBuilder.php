<?php

namespace Drupal\webcomposer_drawer;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Drawer entity entities.
 *
 * @ingroup webcomposer_drawer
 */
class DrawerEntityListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\webcomposer_drawer\Entity\DrawerEntity */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.drawer_entity.edit_form',
      ['drawer_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }
}
