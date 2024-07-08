<?php

namespace Drupal\msw_legal_agreement;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Registration Legal Agreement entities.
 *
 * @ingroup msw_legal_agreement
 */
class MswLegalAgreementListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\msw_legal_agreement\Entity\MswLegalAgreement */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.msw_legal_agreement.edit_form',
      ['msw_legal_agreement' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
