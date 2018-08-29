<?php

namespace Drupal\jamboree_404\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Jamboree 404 Image Entity edit forms.
 *
 * @ingroup jamboree_404
 */
class Jamboree404ImageEntityForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\jamboree_404\Entity\Jamboree404ImageEntity */
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
        drupal_set_message($this->t('Created the %label Jamboree 404 Image Entity.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Jamboree 404 Image Entity.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirectUrl($entity->urlInfo('collection'));
  }

}
