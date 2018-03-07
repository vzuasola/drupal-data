<?php

namespace Drupal\exchange_lobby_tile;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of exchange lobby tile entity entities.
 *
 * @ingroup exchange_lobby_tile
 */
class ExchangeLobbyTileEntityListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\exchange_lobby_tile\Entity\ExchangeLobbyTileEntity */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.exchange_lobby_tile_entity.edit_form',
      ['exchange_lobby_tile_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
