<?php

namespace Drupal\zipang_seo_configuration;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Zipang seo config entity entities.
 *
 * @ingroup zipang_seo_configuration
 */
class ZipangSeoConfigEntityListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\zipang_seo_configuration\Entity\ZipangSeoConfigEntity */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.zipang_seo_config_entity.edit_form',
      ['zipang_seo_config_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
