<?php

namespace Drupal\jamboree_404;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Jamboree 404 Image Entity entities.
 *
 * @ingroup jamboree_404
 */
class Jamboree404ImageEntityListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['field_image'] = $this->t('image');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\jamboree_404\Entity\Jamboree404ImageEntity */
    $row['field_image'] = Link::createFromRoute(
      $entity->label(),
      'entity.jamboree_404_image_entity.edit_form',
      ['jamboree_404_image_entity' => $entity->id()]
    );

    return $row + parent::buildRow($entity);
  }

}
