<?php

namespace Drupal\poker_client_promotions;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Poker client promotions entities.
 *
 * @ingroup poker_client_promotions
 */
class PokerClientPromotionsListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Poker client promotions ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\poker_client_promotions\Entity\PokerClientPromotions */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.poker_client_promotions.edit_form',
      ['poker_client_promotions' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
