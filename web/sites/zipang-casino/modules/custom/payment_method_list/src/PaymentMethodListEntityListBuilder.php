<?php

namespace Drupal\payment_method_list;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Payment Method entity entities.
 *
 * @ingroup payment_method_list
 */
class PaymentMethodListEntityListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\payment_method_list\Entity\PaymentMethodListEntity */
  
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.payment_method_list_entity.edit_form',
      ['payment_method_list_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
