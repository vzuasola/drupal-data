<?php

namespace Drupal\webcomposer_right_side_block\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Inner Page Right Side Block edit forms.
 *
 * @ingroup webcomposer_right_side_block
 */
class RightSideBlockEntityForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\webcomposer_right_side_block\Entity\RightSideBlockEntity */
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
        drupal_set_message($this->t('Created the %label Inner Page Right Side Block.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Inner Page Right Side Block.', [
          '%label' => $entity->label(),
        ]));
    }

    $form_state->setRedirectUrl($entity->urlInfo('collection'));
  }
}
