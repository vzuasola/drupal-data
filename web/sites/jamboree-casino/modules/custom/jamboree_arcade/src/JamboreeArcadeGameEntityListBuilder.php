<?php

namespace Drupal\jamboree_arcade;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Jamboree arcade game entity entities.
 *
 * @ingroup jamboree_arcade
 */
class JamboreeArcadeGameEntityListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Jamboree arcade game entity ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\jamboree_arcade\Entity\JamboreeArcadeGameEntity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.jamboree_arcade_game_entity.edit_form',
      ['jamboree_arcade_game_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
