<?php

namespace Drupal\client_footer_games;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Client footer games entities.
 *
 * @ingroup client_footer_games
 */
class ClientFooterGamesListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Client footer games ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\client_footer_games\Entity\ClientFooterGames */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.client_footer_games.edit_form',
      ['client_footer_games' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
