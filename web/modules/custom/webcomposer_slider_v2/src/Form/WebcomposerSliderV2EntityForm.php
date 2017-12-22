<?php

namespace Drupal\webcomposer_slider_v2\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Webcomposer slider 2.0 entity edit forms.
 *
 * @ingroup webcomposer_slider_v2
 */
class WebcomposerSliderV2EntityForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\webcomposer_slider_v2\Entity\WebcomposerSliderV2Entity */
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
        drupal_set_message($this->t('Created the %label Webcomposer slider 2.0 entity.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Webcomposer slider 2.0 entity.', [
          '%label' => $entity->label(),
        ]));
    }

    $form_state->setRedirectUrl($entity->urlInfo('collection'));
  }

}
