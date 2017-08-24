<?php

namespace Drupal\webcomposer_downloadables;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Downloadable entity entities.
 *
 * @ingroup webcomposer_downloadables
 */
class DownloadableEntityListBuilder extends EntityListBuilder {

  use LinkGeneratorTrait;

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Downloadable entity ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\webcomposer_downloadables\Entity\DownloadableEntity */
    $row['id'] = $entity->id();
    $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.downloadable_entity.edit_form', array(
          'downloadable_entity' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
