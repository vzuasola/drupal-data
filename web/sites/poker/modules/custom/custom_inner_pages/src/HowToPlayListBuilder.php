<?php

namespace Drupal\custom_inner_pages;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of How to play entities.
 *
 * @ingroup custom_inner_pages
 */
class HowToPlayListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('How to play ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\custom_inner_pages\Entity\HowToPlay */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.how_to_play.edit_form',
      ['how_to_play' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
