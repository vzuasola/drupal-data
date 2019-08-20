<?php

namespace Drupal\jamboree_withdraw_method;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Jamboree withdraw method entity entities.
 *
 * @ingroup jamboree_withdraw_method
 */
class JamboreeWithdrawMethodEntityListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\jamboree_withdraw_method\Entity\JamboreeWithdrawMethodEntity */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.jamboree_withdraw_method_entity.edit_form',
      ['jamboree_withdraw_method_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
