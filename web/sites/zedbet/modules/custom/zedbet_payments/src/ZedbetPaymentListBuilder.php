<?php

namespace Drupal\zedbet_payments;

use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\Link;

/**
 * Defines a class to build a listing of Zedbet payment entities.
 *
 * @ingroup zedbet_payments
 */
class ZedbetPaymentListBuilder extends EntityListBuilder {

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
    /* @var $entity \Drupal\zedbet_payments\Entity\ZedbetPayment */

    // Get current and default language for fall back.
    $language = \Drupal::service('language_manager')->getCurrentLanguage()->getId();

    if ($entity->hasTranslation($language)) {
      $entity = $entity->getTranslation($language);
      $name = $entity->get('name')->value;

      $row['name'] = Link::createFromRoute(
        $name,
        'entity.zedbet_payment.edit_form',
        ['zedbet_payment' => $entity->id()]
      );

      return $row + parent::buildRow($entity);
    }
  }

}
