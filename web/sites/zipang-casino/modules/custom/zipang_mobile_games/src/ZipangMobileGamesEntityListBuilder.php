<?php

namespace Drupal\zipang_mobile_games;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Zipang mobile games entity entities.
 *
 * @ingroup zipang_mobile_games
 */
class ZipangMobileGamesEntityListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Zipang mobile games entity ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\zipang_mobile_games\Entity\ZipangMobileGamesEntity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.zipang_mobile_games_entity.edit_form',
      ['zipang_mobile_games_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
