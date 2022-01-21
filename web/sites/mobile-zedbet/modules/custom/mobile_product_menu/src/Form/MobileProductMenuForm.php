<?php

namespace Drupal\mobile_product_menu\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Mobile Product Menu edit forms.
 *
 * @ingroup mobile_product_menu
 */
class MobileProductMenuForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\mobile_product_menu\Entity\MobileProductMenu */
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
        drupal_set_message($this->t('Created the %label Mobile Product Menu.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Mobile Product Menu.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirectUrl($entity->urlInfo('collection'));
  }

}
