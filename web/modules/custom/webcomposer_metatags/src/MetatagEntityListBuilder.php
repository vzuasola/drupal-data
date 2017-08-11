<?php

namespace Drupal\webcomposer_metatags;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Metatag entity entities.
 *
 * @ingroup webcomposer_metatags
 */
class MetatagEntityListBuilder extends EntityListBuilder {

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
    /* @var $entity \Drupal\webcomposer_metatags\Entity\MetatagEntity */
    $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.metatag_entity.edit_form', array(
          'metatag_entity' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
