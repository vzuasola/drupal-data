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
    $header['id'] = $this->t('Social Media ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\webcomposer_social_media\Entity\SocialMediaEntity */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.social_media_entity.edit_form',
      ['social_media_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
