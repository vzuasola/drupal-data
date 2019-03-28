<?php

namespace Drupal\webcomposer_floating_banners\Form;

use Drupal\Core\Entity\ContentEntityDeleteForm;

/**
 * Provides a form for deleting Left floating banner entity entities.
 *
 * @ingroup webcomposer_floating_banners
 */
class LeftFloatingBannerEntityDeleteForm extends ContentEntityDeleteForm {

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, \Drupal\Core\Form\FormStateInterface $form_state) {
    /** @var \Drupal\Core\Entity\ContentEntityInterface $entity */
    $entity = $this->getEntity();

    // // Make sure that deleting a translation does not delete the whole entity.
    if (!$entity->isDefaultTranslation()) {
      $untranslated_entity = $entity->getUntranslated();
      $untranslated_entity->removeTranslation($entity->language()->getId());
      $untranslated_entity->save();
      $form_state->setRedirect('webcomposer_floating_banners.admin_settings_manage');
    }
    else {
      $entity->delete();
      $form_state->setRedirectUrl($this->getRedirectUrl());
    }

  }

}
