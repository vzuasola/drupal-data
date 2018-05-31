<?php

namespace Drupal\jamboree_games;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Games entity entities.
 *
 * @ingroup jamboree_games
 */
class GamesEntityListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\jamboree_games\Entity\GamesEntity */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.games_entity.edit_form',
      ['games_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
