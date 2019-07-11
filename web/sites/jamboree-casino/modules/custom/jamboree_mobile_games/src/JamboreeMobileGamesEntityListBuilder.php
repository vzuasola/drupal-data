<?php

namespace Drupal\jamboree_mobile_games;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Jamboree mobile games entity entities.
 *
 * @ingroup jamboree_mobile_games
 */
class JamboreeMobileGamesEntityListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Jamboree mobile games entity ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\jamboree_mobile_games\Entity\JamboreeMobileGamesEntity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.jamboree_mobile_games_entity.edit_form',
      ['jamboree_mobile_games_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
