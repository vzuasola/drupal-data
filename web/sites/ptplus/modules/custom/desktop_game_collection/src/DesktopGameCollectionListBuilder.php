<?php

namespace Drupal\desktop_game_collection;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing ofDesktop game collection entities.
 *
 * @ingroupdesktop_game_collection
 */
class DesktopGameCollectionListBuilder extends EntityListBuilder {
  
  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Desktop game collection ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\desktop_game_collection\Entity\DesktopGameCollection */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.desktop_game_collection.edit_form',
      ['desktop_game_collection' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }
  
}
