<?php

namespace Drupal\matterhorn_blocks\Form;

use Drupal\Core\Entity\EntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class MatterhornBlockEntityForm.
 *
 * @package Drupal\matterhorn_blocks\Form
 */
class MatterhornBlockEntityForm extends EntityForm {

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form = parent::form($form, $form_state);

    $matterhorn_block_entity = $this->entity;
    $form['label'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Label'),
      '#maxlength' => 255,
      '#default_value' => $matterhorn_block_entity->label(),
      '#description' => $this->t("Label for the Matterhorn block entity."),
      '#required' => TRUE,
    ];

    $form['id'] = [
      '#type' => 'machine_name',
      '#default_value' => $matterhorn_block_entity->id(),
      '#machine_name' => [
        'exists' => '\Drupal\matterhorn_blocks\Entity\MatterhornBlockEntity::load',
      ],
      '#disabled' => !$matterhorn_block_entity->isNew(),
    ];

    /* You will need additional form elements for your custom properties. */

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $matterhorn_block_entity = $this->entity;
    $status = $matterhorn_block_entity->save();

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %label Matterhorn block entity.', [
          '%label' => $matterhorn_block_entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Matterhorn block entity.', [
          '%label' => $matterhorn_block_entity->label(),
        ]));
    }
    $form_state->setRedirectUrl($matterhorn_block_entity->toUrl('collection'));
  }

}
