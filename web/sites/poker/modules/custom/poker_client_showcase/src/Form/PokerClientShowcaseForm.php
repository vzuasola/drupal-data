<?php

namespace Drupal\poker_client_showcase\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Poker client showcase edit forms.
 *
 * @ingroup poker_client_showcase
 */
class PokerClientShowcaseForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\poker_client_showcase\Entity\PokerClientShowcase */
    $form = parent::buildForm($form, $form_state);

    $entity = $this->entity;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
    $publish = $form_state->getValue('field_publish_date');
    $unpublish = $form_state->getValue('field_unpublish_date');

    $publishDate = isset($publish[0]['value']) ? $publish[0]['value']->format('U') : NULL;
    $unpublishDate = isset($unpublish[0]['value']) ? $unpublish[0]['value']->format('U') : NULL;

    if ($unpublishDate && $unpublishDate < $publishDate) {
      $form_state->setErrorByName('field_unpublish_date', t('Unpublish date should be greater than the publish date.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $entity = &$this->entity;

    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Poker client showcase.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Poker client showcase.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirectUrl($entity->urlInfo('collection'));
  }

}
