<?php

namespace Drupal\mobile_sponsor_list;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Mobile sponsor list entities.
 *
 * @ingroup mobile_sponsor_list
 */
class MobileSponsorListListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\mobile_sponsor_list\Entity\MobileSponsorList */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.mobile_sponsor_list.edit_form',
      ['mobile_sponsor_list' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
