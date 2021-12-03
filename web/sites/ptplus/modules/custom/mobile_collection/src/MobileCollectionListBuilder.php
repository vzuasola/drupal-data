<?php

namespace Drupal\mobile_collection;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Mobile collection entities.
 *
 * @ingroup mobile_collection
 */
class MobileCollectionListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Mobile collection ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\mobile_collection\Entity\MobileCollection */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.mobile_collection.edit_form',
      ['mobile_collection' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
