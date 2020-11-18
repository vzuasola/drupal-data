<?php

namespace Drupal\mobile_infobar\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Mobile info bar edit forms.
 *
 * @ingroup mobile_infobar
 */
class MobileInfoBarForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\mobile_infobar\Entity\MobileInfoBar */
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
        drupal_set_message($this->t('Created the %label Mobile info bar.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Mobile info bar.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.mobile_infobar.canonical', ['mobile_infobar' => $entity->id()]);
  }

}
