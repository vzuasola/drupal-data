<?php

namespace Drupal\mobile_sponsor_list_v2;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Mobile Sponsor List version 2.0 entities.
 *
 * @ingroup mobile_sponsor_list_v2
 */
class MobileSponsorListv2ListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Mobile Sponsor List version 2.0 ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\mobile_sponsor_list_v2\Entity\MobileSponsorListv2 */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.mobile_sponsor_list_v2.edit_form',
      ['mobile_sponsor_list_v2' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
