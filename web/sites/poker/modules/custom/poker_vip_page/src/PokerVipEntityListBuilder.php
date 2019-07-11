<?php

namespace Drupal\poker_vip_page;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Poker vip entity entities.
 *
 * @ingroup poker_vip_page
 */
class PokerVipEntityListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Poker vip entity ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\poker_vip_page\Entity\PokerVipEntity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.poker_vip_entity.edit_form',
      ['poker_vip_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
