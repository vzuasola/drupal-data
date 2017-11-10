<?php

namespace Drupal\webcomposer_social_media;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Social Media entities.
 *
 * @ingroup webcomposer_social_media
 */
class SocialMediaEntityListBuilder extends EntityListBuilder {
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
    $name = $entity->label();
    $row['name'] = $name ?: 'Social Media';

    return $row + parent::buildRow($entity);
  }

}
