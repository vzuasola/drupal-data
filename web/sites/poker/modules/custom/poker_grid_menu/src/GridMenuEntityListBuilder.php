<?php

namespace Drupal\poker_grid_menu;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Grid menu entity entities.
 *
 * @ingroup poker_grid_menu
 */
class GridMenuEntityListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Grid menu entity ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\poker_grid_menu\Entity\GridMenuEntity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.grid_menu_entity.edit_form',
      ['grid_menu_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
