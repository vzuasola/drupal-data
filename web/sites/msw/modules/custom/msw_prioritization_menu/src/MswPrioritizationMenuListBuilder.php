<?php

namespace Drupal\msw_prioritization_menu;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Video Call Prioritization Menu entities.
 *
 * @ingroup msw_prioritization_menu
 */
class MswPrioritizationMenuListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\msw_prioritization_menu\Entity\MswPrioritizationMenu */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.msw_prioritization_menu.edit_form',
      ['msw_prioritization_menu' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
