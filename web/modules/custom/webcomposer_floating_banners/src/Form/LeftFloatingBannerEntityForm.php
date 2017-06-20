<?php

namespace Drupal\webcomposer_floating_banners\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Left floating banner entity edit forms.
 *
 * @ingroup webcomposer_floating_banners
 */
class LeftFloatingBannerEntityForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\webcomposer_floating_banners\Entity\LeftFloatingBannerEntity */
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
        drupal_set_message($this->t('Created the %label Floating Banner entity.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Floating Banner entity.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.left_floating_banner_entity.canonical', ['left_floating_banner_entity' => $entity->id()]);
  }

}
