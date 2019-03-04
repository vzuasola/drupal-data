<?php

namespace Drupal\zipang_dropdown_menu;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Dropdown menu entity entities.
 *
 * @ingroup zipang_dropdown_menu
 */
class DropdownMenuEntityListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\zipang_dropdown_menu\Entity\DropdownMenuEntity */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.dropdown_menu_entity.edit_form',
      ['dropdown_menu_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
