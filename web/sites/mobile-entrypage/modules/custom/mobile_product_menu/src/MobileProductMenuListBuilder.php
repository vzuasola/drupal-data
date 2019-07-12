<?php

namespace Drupal\mobile_product_menu;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Mobile Product Menu entities.
 *
 * @ingroup mobile_product_menu
 */
class MobileProductMenuListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\mobile_product_menu\Entity\MobileProductMenu */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.mobile_product_menu.edit_form',
      ['mobile_product_menu' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
