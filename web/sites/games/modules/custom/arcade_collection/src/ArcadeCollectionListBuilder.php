<?php

namespace Drupal\arcade_collection;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Arcade collection entities.
 *
 * @ingroup arcade_collection
 */
class ArcadeCollectionListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Arcade collection ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\arcade_collection\Entity\ArcadeCollection */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.arcade_collection.edit_form',
      ['arcade_collection' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
