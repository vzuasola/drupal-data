<?php

namespace Drupal\jamboree_live_games;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Jamboree live game entity entities.
 *
 * @ingroup jamboree_live_games
 */
class JamboreeLiveGameEntityListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Jamboree live game entity ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\jamboree_live_games\Entity\JamboreeLiveGameEntity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.jamboree_live_game_entity.edit_form',
      ['jamboree_live_game_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
