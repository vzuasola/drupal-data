<?php

namespace Drupal\games_showcase\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Games Showcase entity edit forms.
 *
 * @ingroup games_showcase
 */
class GamesShowcaseEntityForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\games_showcase\Entity\GamesShowcaseEntity */
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
        drupal_set_message($this->t('Created the %label Games Showcase entity.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Games Showcase entity.', [
          '%label' => $entity->label(),
        ]));
    }

    $form_state->setRedirectUrl($entity->urlInfo('collection'));
  }

}
