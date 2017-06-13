<?php

namespace Drupal\webcomposer_floating_banners;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Left floating banner entity entities.
 *
 * @ingroup webcomposer_floating_banners
 */
class LeftFloatingBannerEntityListBuilder extends EntityListBuilder {

  use LinkGeneratorTrait;

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Left floating banner entity ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\webcomposer_floating_banners\Entity\LeftFloatingBannerEntity */
    $row['id'] = $entity->id();
    $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.left_floating_banner_entity.edit_form', array(
          'left_floating_banner_entity' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
