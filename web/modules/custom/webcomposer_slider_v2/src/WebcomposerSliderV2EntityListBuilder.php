<?php

namespace Drupal\webcomposer_slider_v2;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Webcomposer slider entity entities.
 *
 * @ingroup webcomposer_slider
 */
class WebcomposerSliderV2EntityListBuilder extends EntityListBuilder {

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
    /* @var $entity \Drupal\webcomposer_slider_v2\Entity\WebcomposerSliderV2Entity */
    $row['name'] = $this->l(
      $entity->get('field_title')->value,
      new Url(
        'entity.webcomposer_slider_v2_entity.edit_form', array(
          'webcomposer_slider_v2_entity' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
