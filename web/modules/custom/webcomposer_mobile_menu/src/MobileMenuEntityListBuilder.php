<?php

namespace Drupal\webcomposer_mobile_menu;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Mobile menu entity entities.
 *
 * @ingroup webcomposer_mobile_menu
 */
class MobileMenuEntityListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\webcomposer_mobile_menu\Entity\MobileMenuEntity */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.mobile_menu_entity.edit_form',
      ['mobile_menu_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
