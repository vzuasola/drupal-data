<?php

namespace Drupal\lucky_baby_all_games_config;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Lucky Baby all games entity entities.
 *
 * @ingroup lucky_baby_all_games_config
 */
class LuckyBabyAllGamesEntityListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Lucky Baby all games entity ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\lucky_baby_all_games_config\Entity\LuckyBabyAllGamesEntity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.lucky_baby_all_games_entity.edit_form',
      ['lucky_baby_all_games_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
