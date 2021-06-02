<?php

namespace Drupal\msw_terms_of_use\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * MSW terms of use configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "msw_terms_of_use",
 *   route = {
 *     "title" = "Terms of Use Configuration",
 *     "path" = "/admin/config/msw/terms_of_use/configuration",
 *   },
 *   menu = {
 *     "title" = "Terms of Use Configuration",
 *     "description" = "Provides configuration for Terms of Use",
 *     "parent" = "msw_config.list",
 *   },
 * )
 */
class TermsofUse extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['msw_terms_of_use.msw_terms_of_use_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {
    $form['terms_of_use_form_general_config']['terms_of_use_header'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Header'),
      '#default_value' => $this->get('terms_of_use_header'),
      '#translatable' => TRUE,
    ];

    $form['terms_of_use_form_general_config']['terms_of_use_footer'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Footer'),
      '#default_value' => $this->get('terms_of_use_footer'),
      '#translatable' => TRUE,
    ];

    $body_content = $this->get('terms_of_use_content');
    $form['terms_of_use_form_general_config']['terms_of_use_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Terms of Use Content'),
      '#default_value' => $body_content['value'],
      '#format' => $body_content['format'],
      '#translatable' => TRUE,
    ];

    $form['terms_of_use_form_general_config']['terms_of_use_accept'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Accept'),
      '#default_value' => $this->get('terms_of_use_accept'),
      '#translatable' => TRUE,
    ];

    $form['terms_of_use_form_general_config']['terms_of_use_decline'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Decline'),
      '#default_value' => $this->get('terms_of_use_decline'),
      '#translatable' => TRUE,
    ];

    return $form;
  }
}
