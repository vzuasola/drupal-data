<?php

namespace Drupal\news_and_updates\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for News and updates entity edit forms.
 *
 * @ingroup news_and_updates
 */
class NewsAndUpdatesEntityForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\news_and_updates\Entity\NewsAndUpdatesEntity */
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
        drupal_set_message($this->t('Created the %label News and updates entity.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label News and updates entity.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirectUrl($entity->urlInfo('collection'));
  }

}
