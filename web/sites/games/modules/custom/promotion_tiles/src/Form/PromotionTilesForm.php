<?php

namespace Drupal\promotion_tiles\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for Promotion tiles edit forms.
 *
 * @ingroup promotion_tiles
 */
class PromotionTilesForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\promotion_tiles\Entity\PromotionTiles */
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
        drupal_set_message($this->t('Created the %label Promotion tiles.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Promotion tiles.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.promotion_tiles.canonical', ['promotion_tiles' => $entity->id()]);
  }

}
