<?php

namespace Drupal\desktop_slider\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller forDesktop slider edit forms.
 *
 * @ingroupdesktop_slider
 */
class DesktopSliderForm extends ContentEntityForm
{
  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    /* @var $entity \Drupal\desktop_slider\Entity\DesktopSlider */
    $form = parent::buildForm($form, $form_state);
    $entity = $this->entity;

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state)
  {
    $entity = &$this->entity;
    $status = parent::save($form, $form_state);

    switch ($status) {
      case SAVED_NEW:
        drupal_set_message($this->t('Created the %labelDesktop slider.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %labelDesktop slider.', [
          '%label' => $entity->label(),
        ]));
    }
    $form_state->setRedirect('entity.desktop_slider.canonical', ['desktop_slider' => $entity->id()]);
  }
}
