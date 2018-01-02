<?php

namespace Drupal\esports\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Esports channel entity edit forms.
 *
 * @ingroup esports
 */
class ESportsChannelEntityForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\esports\Entity\ESportsChannelEntity */
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
        drupal_set_message($this->t('Created the %label Esports channel entity.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Esports channel entity.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.e_sports_channel_entity.canonical', ['e_sports_channel_entity' => $entity->id()]);
  }

}
