<?php

namespace Drupal\tournament_api;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing ofTournament Api entities.
 *
 * @ingrouptournament_api
 */
class TournamentApiListBuilder extends EntityListBuilder
{
  /**
   * {@inheritdoc}
   */
  public function buildHeader()
  {
    $header['id'] = $this->t('Tournament Api ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity)
  {
    /* @var $entity \Drupal\tournament_api\Entity\TournamentApi */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.tournament_api.edit_form',
      ['tournament_api' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }
}
