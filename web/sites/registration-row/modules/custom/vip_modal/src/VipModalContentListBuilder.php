<?php

namespace Drupal\vip_modal;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Vip Modal Content Entity entities.
 *
 * @ingroup vip_modal
 */
class VipModalContentListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\vip_modal\Entity\VipModalContent */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.vip_modal_entity.edit_form',
      ['vip_modal_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
