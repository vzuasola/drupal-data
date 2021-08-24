<?php

namespace Drupal\desktop_slider;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing ofDesktop slider entities.
 *
 * @ingroupdesktop_slider
 */
class DesktopSliderListBuilder extends EntityListBuilder
{
  /**
   * {@inheritdoc}
   */
  public function buildHeader()
  {
    $header['id'] = $this->t('Desktop slider ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity)
  {
    /* @var $entity \Drupal\desktop_slider\Entity\DesktopSlider */
    $row['id'] = $entity->id();
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.desktop_slider.edit_form',
      ['desktop_slider' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }
}
