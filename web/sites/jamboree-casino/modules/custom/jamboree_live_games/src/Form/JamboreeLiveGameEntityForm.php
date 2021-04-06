<?php

namespace Drupal\jamboree_live_games\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Jamboree live game entity edit forms.
 *
 * @ingroup jamboree_live_games
 */
class JamboreeLiveGameEntityForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\jamboree_live_games\Entity\JamboreeLiveGameEntity */
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
        drupal_set_message($this->t('Created the %label Jamboree live game entity.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Jamboree live game entity.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.jamboree_live_game_entity.canonical', ['jamboree_live_game_entity' => $entity->id()]);
  }

}
