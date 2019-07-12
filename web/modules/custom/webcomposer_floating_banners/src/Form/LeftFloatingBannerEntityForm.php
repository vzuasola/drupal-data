<?php

namespace Drupal\webcomposer_floating_banners\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\views\Views;

/**
 * Form controller for Left floating banner entity edit forms.
 *
 * @ingroup webcomposer_floating_banners
 */
class LeftFloatingBannerEntityForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    /* @var $entity \Drupal\webcomposer_floating_banners\Entity\LeftFloatingBannerEntity */
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
        drupal_set_message($this->t('Created the %label Floating Banner entity.', [
          '%label' => $entity->label(),
        ]));
        break;

      default:
        drupal_set_message($this->t('Saved the %label Floating Banner entity.', [
          '%label' => $entity->label(),
        ]));
    }

    $view = Views::getView('floating_banner');
    $redirectUrl = $entity->urlInfo('collection');

    if (isset($view) && $view->access('manage')) {
      $redirectUrl = Url::fromRoute('webcomposer_floating_banners.admin_settings_manage');
    }

    $form_state->setRedirectUrl($redirectUrl);
  }

}
