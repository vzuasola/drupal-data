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
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
    $publish = $form_state->getValue('field_publish_date');
    $unpublish = $form_state->getValue('field_unpublish_date');

    $publishDate = isset($publish[0]['value']) ? $publish[0]['value']->format('U') : NULL;
    $unpublishDate = isset($unpublish[0]['value']) ? $unpublish[0]['value']->format('U') : NULL;
    $loginState = $form_state->getValue('field_log_in_state');
    $preTileImage = $form_state->getValue('field_pre_slelect_image_size');
    $postTileImage = $form_state->getValue('field_post_slelect_image_size');

    if ($unpublishDate && $unpublishDate < $publishDate) {
      $form_state->setErrorByName('field_unpublish_date', t('Unpublish date should be greater than the publish date.'));
    }
    // Validation for pre promotion fields.
    if ($loginState[0]['value'] == 0 && $preTileImage[0]['value'] == NULL) {
      $form_state->setErrorByName('$bannerImage', t('Pre promotion field(s) is required.'));
    }
    // Validation for post promotion fields.
    if ($loginState[1]['value'] == 1 && $postTileImage[0]['value'] == NULL) {
      $form_state->setErrorByName('$bannerImagePost', t('Post promotion field(s) is required.'));
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
        drupal_set_message($this->t('Created the %label Promotion tiles.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Promotion tiles.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirectUrl($entity->urlInfo('collection'));
  }

}
