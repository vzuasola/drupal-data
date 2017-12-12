<?php

namespace Drupal\games_showcase;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Games Showcase entity entities.
 *
 * @ingroup games_showcase
 */
class GamesShowcaseEntityListBuilder extends EntityListBuilder {

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
    /* @var $entity \Drupal\games_showcase\Entity\GamesShowcaseEntity */
    $row['name'] = $this->l(
      $entity->get('field_title')->value,
      new Url(
        'entity.games_showcase_entity.edit_form', array(
          'games_showcase_entity' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
