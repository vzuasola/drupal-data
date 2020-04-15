<?php

namespace Drupal\mobile_sponsor_list_v2\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Mobile Sponsor List version 2.0 edit forms.
 *
 * @ingroup mobile_sponsor_list_v2
 */
class MobileSponsorListv2Form extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\mobile_sponsor_list_v2\Entity\DefaultEntity */
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
        drupal_set_message($this->t('Created the %label Mobile Sponsor List version 2.0.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Mobile Sponsor List version 2.0.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.mobile_sponsor_list_v2.canonical', ['mobile_sponsor_list_v2' => $entity->id()]);
  }

}
