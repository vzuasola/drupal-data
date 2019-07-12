<?php

namespace Drupal\zipang_desktop_games;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Zipang desktop games entity entities.
 *
 * @ingroup zipang_desktop_games
 */
class ZipangDesktopGamesEntityListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Zipang desktop games entity ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\zipang_desktop_games\Entity\ZipangDesktopGamesEntity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.zipang_desktop_games_entity.edit_form',
      ['zipang_desktop_games_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
