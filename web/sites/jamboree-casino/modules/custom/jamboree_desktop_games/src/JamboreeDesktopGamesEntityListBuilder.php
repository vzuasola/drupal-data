<?php

namespace Drupal\jamboree_desktop_games;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Jamboree desktop games entity entities.
 *
 * @ingroup jamboree_desktop_games
 */
class JamboreeDesktopGamesEntityListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Jamboree desktop games entity ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\jamboree_desktop_games\Entity\JamboreeDesktopGamesEntity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.jamboree_desktop_games_entity.edit_form',
      ['jamboree_desktop_games_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
