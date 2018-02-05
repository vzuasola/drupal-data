<?php

namespace Drupal\webcomposer_partner_responsive;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Partner - Responsive entities.
 *
 * @ingroup webcomposer_partner_responsive
 */
class PartnerResponsiveEntityListBuilder extends EntityListBuilder {
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
    /* @var $entity \Drupal\webcomposer_partner_responsive\Entity\PartnerResponsiveEntity */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.partner_responsive_entity.edit_form',
      ['partner_responsive_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
