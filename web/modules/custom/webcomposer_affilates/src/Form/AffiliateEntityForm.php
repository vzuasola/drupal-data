<?php

namespace Drupal\webcomposer_affilates\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class AffiliateEntityForm.
 *
 * @package Drupal\webcomposer_affilates\Form
 */
class AffiliateEntityForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $affiliate_entity = $this->entity;

    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Tracking code'),
      '#maxlength' => 255,
      '#default_value' => $affiliate_entity->label(),
      '#description' => $this->t("The tracking code that will be tracked, example are
        <strong>btag</strong>. Make sure that code is the same with machine name."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $affiliate_entity->id(),
      '#machine_name' => [
        'exists' => '\Drupal\webcomposer_affilates\Entity\AffiliateEntity::load',
      ],
      '#disabled' => !$affiliate_entity->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $affiliate_entity = $this->entity;
    $status = $affiliate_entity->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Affiliate entity.', [
          '%label' => $affiliate_entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Affiliate entity.', [
          '%label' => $affiliate_entity->label(),
        ]));
    }
    $form_state->setRedirectUrl($affiliate_entity->toUrl('collection'));
  }

}
