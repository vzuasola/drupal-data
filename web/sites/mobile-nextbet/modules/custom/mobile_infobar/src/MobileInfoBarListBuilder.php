<?php

namespace Drupal\mobile_infobar;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Mobile info bar entities.
 *
 * @ingroup mobile_infobar
 */
class MobileInfoBarListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Mobile info bar ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\mobile_infobar\Entity\MobileInfoBar */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.mobile_infobar.edit_form',
      ['mobile_infobar' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
