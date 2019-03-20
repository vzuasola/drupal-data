<?php

namespace Drupal\ghana_quick_links;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Quick links entity entities.
 *
 * @ingroup ghana_quick_links
 */
class QuickLinksEntityListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\ghana_quick_links\Entity\QuickLinksEntity */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.quick_links_entity.edit_form',
      ['quick_links_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
