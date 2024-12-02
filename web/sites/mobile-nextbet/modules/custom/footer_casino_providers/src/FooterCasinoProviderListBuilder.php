<?php

namespace Drupal\footer_casino_providers;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Footer Casino Provider entities.
 *
 * @ingroup footer_casino_providers
 */
class FooterCasinoProviderListBuilder extends EntityListBuilder {

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
    /* @var $entity \Drupal\footer_casino_providers\Entity\FooterCasinoProvider */

    // Get current and default language for fall back.
    $language = \Drupal::service('language_manager')->getCurrentLanguage()->getId();

    if ($entity->hasTranslation($language)) {
      $entity = $entity->getTranslation($language);
      $name = $entity->get('name')->value;

      $row['name'] = Link::createFromRoute(
        $name,
        'entity.footer_casino_providers.edit_form',
        ['footer_casino_providers' => $entity->id()]
      );

      return $row + parent::buildRow($entity);
    }
  }

}
