<?php

namespace Drupal\jamboree_payment_method\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Payment method entity edit forms.
 *
 * @ingroup jamboree_payment_method
 */
class PaymentMethodEntityForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\jamboree_payment_method\Entity\PaymentMethodEntity */
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
        drupal_set_message($this->t('Created the %label Payment method entity.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Payment method entity.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.payment_method_entity.canonical', ['payment_method_entity' => $entity->id()]);
  }

}
