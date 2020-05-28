<?php

namespace Drupal\nextbet_front_blocks;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Nextbet front block entities.
 *
 * @ingroup nextbet_front_blocks
 */
class NextbetFrontBlockListBuilder extends EntityListBuilder {

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
    /* @var $entity \Drupal\nextbet_front_blocks\Entity\NextbetFrontBlock */

    // Get current and default language for fall back.
    $language = \Drupal::service('language_manager')->getCurrentLanguage()->getId();

    if ($entity->hasTranslation($language)) {
      $entity = $entity->getTranslation($language);
      $name = $entity->get('name')->value;

      $row['name'] = $this->l(
        $name,
        new Url(
          'entity.nextbet_front_block.edit_form',
          array(
            'nextbet_front_block' => $entity->id(),
          )
        )
      );

      return $row + parent::buildRow($entity);
    }
  }

}
