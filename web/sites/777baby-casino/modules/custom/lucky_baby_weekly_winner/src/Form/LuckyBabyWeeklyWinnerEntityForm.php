<?php

namespace Drupal\lucky_baby_weekly_winner\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Lucky baby weekly winner entity edit forms.
 *
 * @ingroup lucky_baby_weekly_winner
 */
class LuckyBabyWeeklyWinnerEntityForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\lucky_baby_weekly_winner\Entity\LuckyBabyWeeklyWinnerEntity */
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
        drupal_set_message($this->t('Created the %label Lucky baby weekly winner entity.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Lucky baby weekly winner entity.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirectUrl($entity->urlInfo('collection'));
  }

}
