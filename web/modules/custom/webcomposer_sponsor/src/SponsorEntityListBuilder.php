<?php

namespace Drupal\webcomposer_sponsor;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Sponsor entities.
 *
 * @ingroup webcomposer_sponsor
 */
class SponsorEntityListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Sponsor ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\webcomposer_sponsor\Entity\SponsorEntity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.sponsor_entity.edit_form',
      ['sponsor_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
