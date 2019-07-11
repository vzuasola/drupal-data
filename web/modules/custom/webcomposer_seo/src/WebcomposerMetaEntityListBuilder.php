<?php

namespace Drupal\webcomposer_seo;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Webcomposer meta entity entities.
 *
 * @ingroup webcomposer_seo
 */
class WebcomposerMetaEntityListBuilder extends EntityListBuilder {


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
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.webcomposer_meta_entity.edit_form',
      ['webcomposer_meta_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
