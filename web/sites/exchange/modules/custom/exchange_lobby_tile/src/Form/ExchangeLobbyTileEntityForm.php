<?php

namespace Drupal\exchange_lobby_tile\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Keno lobby tile entity edit forms.
 *
 * @ingroup exchange_lobby_tile
 */
class ExchangeLobbyTileEntityForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\exchange_lobby_tile\Entity\ExchangeLobbyTileEntity */
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
        drupal_set_message($this->t('Created the %label exchange lobby tile entity.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label exchange lobby tile entity.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirectUrl($entity->urlInfo('collection'));
  }

}
