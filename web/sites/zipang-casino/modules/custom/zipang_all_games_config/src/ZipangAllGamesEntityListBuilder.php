<?php

namespace Drupal\zipang_all_games_config;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Zipang all games entity entities.
 *
 * @ingroup zipang_all_games_config
 */
class ZipangAllGamesEntityListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Zipang all games entity ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\zipang_all_games_config\Entity\ZipangAllGamesEntity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.zipang_all_games_entity.edit_form',
      ['zipang_all_games_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
