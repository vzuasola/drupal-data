<?php

namespace Drupal\nextbet_payments;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Nextbet payment entities.
 *
 * @ingroup nextbet_payments
 */
class NextbetPaymentListBuilder extends EntityListBuilder {

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
    /* @var $entity \Drupal\nextbet_payments\Entity\NextbetPayment */

    // Get current and default language for fall back.
    $language = \Drupal::service('language_manager')->getCurrentLanguage()->getId();

    if ($entity->hasTranslation($language)) {
      $entity = $entity->getTranslation($language);
      $name = $entity->get('name')->value;

      $row['name'] = $this->l(
        $name,
        new Url(
          'entity.nextbet_payment.edit_form',
          array(
            'nextbet_payment' => $entity->id(),
          )
        )
      );

      return $row + parent::buildRow($entity);
    }
  }

}
