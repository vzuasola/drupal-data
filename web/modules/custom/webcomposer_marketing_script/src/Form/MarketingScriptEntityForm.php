<?php

namespace Drupal\webcomposer_marketing_script\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Marketing Script edit forms.
 *
 * @ingroup webcomposer_marketing_script
 */
class MarketingScriptEntityForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\webcomposer_marketing_script\Entity\MarketingScriptEntity */
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
        drupal_set_message($this->t('Created the %label Marketing Script.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Marketing Script.', [
          '%label' => $entity->label(),
        ]));
    }
    
    $form_state->setRedirectUrl($entity->urlInfo('collection'));
  }

}
