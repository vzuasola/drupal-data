<?php

namespace Drupal\mobile_marketing_space;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Mobile marketing space entities.
 *
 * @ingroup mobile_marketing_space
 */
class MobileMarketingSpaceListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Mobile marketing space ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\mobile_marketing_space\Entity\MobileMarketingSpace */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.mobile_marketing_space.edit_form',
      ['mobile_marketing_space' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
