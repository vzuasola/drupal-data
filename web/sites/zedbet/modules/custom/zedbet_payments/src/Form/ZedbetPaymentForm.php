<?php

namespace Drupal\zedbet_payments\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Zedbet payment edit forms.
 *
 * @ingroup zedbet_payments
 */
class ZedbetPaymentForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
    public function buildForm(array $form, FormStateInterface $form_state) {
        /* @var $entity \Drupal\zedbet_payments\Entity\ZedbetPayment */
        $form = parent::buildForm($form, $form_state);

        $entity = $this->entity;

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function save(array $form, FormStateInterface $form_state) {
        $entity = &$this->entity;

        $status = parent::save($form, $form_state);

        switch ($status) {
            case SAVED_NEW:
              drupal_set_message($this->t('Created the %label Zedbet payment', [
                '%label' => $entity->label(),
              ]));
              break;

            default:
              drupal_set_message($this->t('Saved the %label Zedbet payment', [
                '%label' => $entity->label(),
              ]));
        }
        $form_state->setRedirectUrl($entity->urlInfo('collection'));
    }
}
