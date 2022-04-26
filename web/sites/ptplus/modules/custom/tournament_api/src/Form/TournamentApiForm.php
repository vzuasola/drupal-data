<?php

namespace Drupal\tournament_api\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller forTournament Api edit forms.
 *
 * @ingrouptournament_api
 */
class TournamentApiForm extends ContentEntityForm
{
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    /* @var $entity \Drupal\tournament_api\Entity\TournamentApi */
    $form = parent::buildForm($form, $form_state);
    $entity = $this->entity;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state)
  {
    $entity = &$this->entity;
    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %labelTournament Api.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %labelTournament Api.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.tournament_api.canonical', ['tournament_api' => $entity->id()]);
  }
}
