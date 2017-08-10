<?php

namespace Drupal\webcomposer_slider;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Web Composer Slider entities.
 *
 * @ingroup webcomposer_slider
 */
class WebComposerSliderListBuilder extends EntityListBuilder {

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
    /* @var $entity \Drupal\webcomposer_slider\Entity\WebComposerSlider */
    $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.web_composer_slider.edit_form', array(
          'web_composer_slider' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
