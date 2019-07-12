<?php

namespace Drupal\registration_theme;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Registration theme entity entities.
 *
 * @ingroup registration_theme
 */
class RegistrationThemeEntityListBuilder extends EntityListBuilder {


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
    /* @var $entity \Drupal\registration_theme\Entity\RegistrationThemeEntity */
    $row['name'] = Link::createFromRoute(
      $entity->label(),
      'entity.registration_theme_entity.edit_form',
      ['registration_theme_entity' => $entity->id()]
    );
    return $row + parent::buildRow($entity);
  }

}
