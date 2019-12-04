<?php

namespace Drupal\news_and_updates;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of News and updates entity entities.
 *
 * @ingroup news_and_updates
 */
class NewsAndUpdatesEntityListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.news_and_updates_entity.edit_form',
      ['news_and_updates_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
