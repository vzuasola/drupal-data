<?php

namespace Drupal\lucky_baby_all_games_config\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Lucky Baby all games entity edit forms.
 *
 * @ingroup lucky_baby_all_games_config
 */
class LuckyBabyAllGamesEntityForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\lucky_baby_all_games_config\Entity\LuckyBabyAllGamesEntity */
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
        drupal_set_message($this->t('Created the %label Lucky Baby all games entity.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Lucky Baby all games entity.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.lucky_baby_all_games_entity.collection');
  }

}
