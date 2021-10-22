<?php

namespace Drupal\desktop_collection;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing ofDesktop collection entities.
 *
 * @ingroupdesktop_collection
 */
class DesktopCollectionListBuilder extends EntityListBuilder {

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Desktop collection ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\desktop_collection\Entity\DesktopCollection */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.desktop_collection.edit_form',
      ['desktop_collection' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }
  
}
