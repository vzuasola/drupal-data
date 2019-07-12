<?php

namespace Drupal\poker_client_showcase;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Poker client showcase entities.
 *
 * @ingroup poker_client_showcase
 */
class PokerClientShowcaseListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Poker client showcase ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\poker_client_showcase\Entity\PokerClientShowcase */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.poker_client_showcase.edit_form',
      ['poker_client_showcase' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
