<?php

namespace Drupal\desktop_collection\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller forDesktop collection edit forms.
 *
 * @ingroupdesktop_collection
 */
class DesktopCollectionForm extends ContentEntityForm {
  
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\desktop_collection\Entity\DesktopCollection */
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
        drupal_set_message($this->t('Created the %labelDesktop collection.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %labelDesktop collection.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.desktop_collection.canonical', ['desktop_collection' => $entity->id()]);
  }

}
