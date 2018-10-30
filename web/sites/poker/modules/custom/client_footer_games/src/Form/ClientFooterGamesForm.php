<?php

namespace Drupal\client_footer_games\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Client footer games edit forms.
 *
 * @ingroup client_footer_games
 */
class ClientFooterGamesForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\client_footer_games\Entity\ClientFooterGames */
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
        drupal_set_message($this->t('Created the %label Client footer games.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Client footer games.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.client_footer_games.canonical', ['client_footer_games' => $entity->id()]);
  }

}
