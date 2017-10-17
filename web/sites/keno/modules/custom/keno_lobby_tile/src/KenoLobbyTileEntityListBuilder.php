<?php

namespace Drupal\keno_lobby_tile;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Keno lobby tile entity entities.
 *
 * @ingroup keno_lobby_tile
 */
class KenoLobbyTileEntityListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\keno_lobby_tile\Entity\KenoLobbyTileEntity */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.keno_lobby_tile_entity.edit_form',
      ['keno_lobby_tile_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
