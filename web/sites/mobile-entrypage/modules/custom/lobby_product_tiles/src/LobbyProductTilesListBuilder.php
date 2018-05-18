<?php

namespace Drupal\lobby_product_tiles;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Lobby Product Tiles entities.
 *
 * @ingroup lobby_product_tiles
 */
class LobbyProductTilesListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\lobby_product_tiles\Entity\LobbyProductTiles */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.lobby_product_tiles.edit_form',
      ['lobby_product_tiles' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
