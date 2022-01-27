<?php

namespace Drupal\zedbet_front_blocks;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Zedbet front block entities.
 *
 * @ingroup zedbet_front_blocks
 */
class ZedbetFrontBlockListBuilder extends EntityListBuilder {

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
    /* @var $entity \Drupal\zedbet_front_blocks\Entity\ZedbetFrontBlock */

    // Get current and default language for fall back.
    $language = \Drupal::service('language_manager')->getCurrentLanguage()->getId();

    if ($entity->hasTranslation($language)) {
      $entity = $entity->getTranslation($language);
      $name = $entity->get('name')->value;

      $row['name'] = $this->l(
        $name,
        new Url(
          'entity.zedbet_front_block.edit_form',
          array(
            'zedbet_front_block' => $entity->id(),
          )
        )
      );

      return $row + parent::buildRow($entity);
    }
  }

}
