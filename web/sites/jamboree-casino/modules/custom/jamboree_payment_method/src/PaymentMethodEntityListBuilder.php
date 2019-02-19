<?php

namespace Drupal\jamboree_payment_method;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Payment method entity entities.
 *
 * @ingroup jamboree_payment_method
 */
class PaymentMethodEntityListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Payment method entity ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\jamboree_payment_method\Entity\PaymentMethodEntity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.payment_method_entity.edit_form',
      ['payment_method_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
