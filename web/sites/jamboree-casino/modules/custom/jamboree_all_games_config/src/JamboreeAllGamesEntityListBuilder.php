<?php

namespace Drupal\jamboree_all_games_config;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Jamboree all games entity entities.
 *
 * @ingroup jamboree_all_games_config
 */
class JamboreeAllGamesEntityListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Jamboree all games entity ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\jamboree_all_games_config\Entity\JamboreeAllGamesEntity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.jamboree_all_games_entity.edit_form',
      ['jamboree_all_games_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
