<?php

namespace Drupal\jamboree_arcade\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Jamboree arcade game entity edit forms.
 *
 * @ingroup jamboree_arcade
 */
class JamboreeArcadeGameEntityForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\jamboree_arcade\Entity\JamboreeArcadeGameEntity */
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
        drupal_set_message($this->t('Created the %label Jamboree arcade game entity.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Jamboree arcade game entity.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.jamboree_arcade_game_entity.canonical', ['jamboree_arcade_game_entity' => $entity->id()]);
  }

}
