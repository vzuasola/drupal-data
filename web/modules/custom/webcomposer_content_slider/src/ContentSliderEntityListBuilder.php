<?php

namespace Drupal\webcomposer_content_slider;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Webcomposer slider entity entities.
 *
 * @ingroup webcomposer_content_slider
 */
class ContentSliderEntityListBuilder extends EntityListBuilder {

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
    /* @var $entity \Drupal\webcomposer_content_slider\Entity\ContentSliderEntity */
    $row['name'] = $this->l(
      $entity->get('field_title')->value,
      new Url(
        'entity.content_slider_entity.edit_form', array(
          'content_slider_entity' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
