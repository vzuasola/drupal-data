<?php

namespace Drupal\games_page_background;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Game Page Background entities.
 *
 * @ingroup games_page_background
 */
class GamePageBackgroundListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Game Page Background ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\games_page_background\Entity\GamePageBackground */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.game_page_background.edit_form',
      ['game_page_background' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
