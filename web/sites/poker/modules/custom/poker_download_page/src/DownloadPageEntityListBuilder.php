<?php

namespace Drupal\poker_download_page;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Download page entity entities.
 *
 * @ingroup poker_download_page
 */
class DownloadPageEntityListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Download page entity ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\poker_download_page\Entity\DownloadPageEntity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.download_page_entity.edit_form',
      ['download_page_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
