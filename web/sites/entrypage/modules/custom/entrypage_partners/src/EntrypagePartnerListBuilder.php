<?php

namespace Drupal\entrypage_partners;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Routing\LinkGeneratorTrait;
use Drupal\Core\Url;

/**
 * Defines a class to build a listing of Entrypage partner entities.
 *
 * @ingroup entrypage_partners
 */
class EntrypagePartnerListBuilder extends EntityListBuilder {

  use LinkGeneratorTrait;

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['title'] = $this->t('Title');
    return $header + parent::buildHeader();
  }

  /**
   * {@inheritdoc}
   */
  public function buildRow(EntityInterface $entity) {
    /* @var $entity \Drupal\webcomposer_floating_banners\Entity\LeftFloatingBannerEntity */

    // Get current and default language for fall back.
    $langCode = \Drupal::service('language_manager')->getCurrentLanguage()->getId();

    if ($entity->hasTranslation($langCode)) {
      $entity = $entity->getTranslation($langCode);
      $title = $entity->get('field_title')->value;

      $row['title'] = $this->l(
        $title,
        new Url(
          'entity.entrypage_partner.edit_form', 
          array(
            'entrypage_partner' => $entity->id(),
          )
        )
      );

      return $row + parent::buildRow($entity);
    }
  }
}
