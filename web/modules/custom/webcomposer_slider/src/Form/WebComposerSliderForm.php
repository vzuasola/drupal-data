<?php

namespace Drupal\webcomposer_slider\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Web Composer Slider edit forms.
 *
 * @ingroup webcomposer_slider
 */
class WebComposerSliderForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\webcomposer_slider\Entity\WebComposerSlider */
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
        drupal_set_message($this->t('Created the %label Web Composer Slider.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Web Composer Slider.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.web_composer_slider.canonical', ['web_composer_slider' => $entity->id()]);
  }

}
