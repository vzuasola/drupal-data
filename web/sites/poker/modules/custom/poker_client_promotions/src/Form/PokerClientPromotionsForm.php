<?php

namespace Drupal\poker_client_promotions\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Poker client promotions edit forms.
 *
 * @ingroup poker_client_promotions
 */
class PokerClientPromotionsForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\poker_client_promotions\Entity\PokerClientPromotions */
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
        drupal_set_message($this->t('Created the %label Poker client promotions.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Poker client promotions.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.poker_client_promotions.canonical', ['poker_client_promotions' => $entity->id()]);
  }

}
