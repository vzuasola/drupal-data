<?php

namespace Drupal\desktop_game_collection\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller forDesktop game collection edit forms.
 *
 * @ingroupdesktop_game_collection
 */
class DesktopGameCollectionForm extends ContentEntityForm {  
  
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\desktop_game_collection\Entity\DesktopGameCollection */
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
        drupal_set_message($this->t('Created the %labelDesktop game collection.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %labelDesktop game collection.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.desktop_game_collection.canonical', ['desktop_game_collection' => $entity->id()]);
  }
  
}
