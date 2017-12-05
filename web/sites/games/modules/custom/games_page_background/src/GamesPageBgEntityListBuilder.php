<?php

namespace Drupal\games_page_background;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Games Page Background entities.
 *
 * @ingroup games_page_background
 */
class GamesPageBgEntityListBuilder extends EntityListBuilder {

  use LinkGeneratorTrait;

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['id'] = $this->t('Games Page Background ID');
    $header['name'] = $this->t('Name');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\games_page_background\Entity\GamesPageBgEntity */
    $row['id'] = $entity->id();
    $row['name'] = $this->l(
      $entity->label(),
      new Url(
        'entity.games_page_bg_entity.edit_form', array(
          'games_page_bg_entity' => $entity->id(),
        )
      )
    );
    return $row + parent::buildRow($entity);
  }

}
