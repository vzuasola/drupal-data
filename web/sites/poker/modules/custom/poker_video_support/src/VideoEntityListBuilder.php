<?php

namespace Drupal\poker_video_support;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Video entity entities.
 *
 * @ingroup poker_video_support
 */
class VideoEntityListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Video entity ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\poker_video_support\Entity\VideoEntity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.poker_video_entity.edit_form',
      ['poker_video_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
