<?php

namespace Drupal\webcomposer_partner;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Partner entity entities.
 *
 * @ingroup webcomposer_partner
 */
class PartnerEntityListBuilder extends EntityListBuilder {

  use LinkGeneratorTrait;

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
    /* @var $entity \Drupal\webcomposer_partner\Entity\PartnerEntity */
    $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.partner_entity.edit_form', array(
          'partner_entity' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
