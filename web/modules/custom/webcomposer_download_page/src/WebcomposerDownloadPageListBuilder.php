<?php

namespace Drupal\webcomposer_download_page;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Webcomposer download page entities.
 *
 * @ingroup webcomposer_download_page
 */
class WebcomposerDownloadPageListBuilder extends EntityListBuilder {


  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Webcomposer download page ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\webcomposer_download_page\Entity\WebcomposerDownloadPage */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.webcomposer_download_page.edit_form',
      ['webcomposer_download_page' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
