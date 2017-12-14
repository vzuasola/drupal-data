<?php

namespace Drupal\esports;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Esports channel entity entities.
 *
 * @ingroup esports
 */
class ESportsChannelEntityListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Esports channel entity ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\esports\Entity\ESportsChannelEntity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.e_sports_channel_entity.edit_form',
      ['e_sports_channel_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
