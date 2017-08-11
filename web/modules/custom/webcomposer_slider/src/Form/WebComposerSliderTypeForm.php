<?php

namespace Drupal\webcomposer_slider\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class WebComposerSliderTypeForm.
 *
 * @package Drupal\webcomposer_slider\Form
 */
class WebComposerSliderTypeForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $web_composer_slider_type = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $web_composer_slider_type->label(),
      '#description' => $this->t("Label for the Web Composer Slider type."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $web_composer_slider_type->id(),
      '#machine_name' => [
        'exists' => '\Drupal\webcomposer_slider\Entity\WebComposerSliderType::load',
      ],
      '#disabled' => !$web_composer_slider_type->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $web_composer_slider_type = $this->entity;
    $status = $web_composer_slider_type->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Web Composer Slider type.', [
          '%label' => $web_composer_slider_type->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Web Composer Slider type.', [
          '%label' => $web_composer_slider_type->label(),
        ]));
    }
    $form_state->setRedirectUrl($web_composer_slider_type->toUrl('collection'));
  }

}
