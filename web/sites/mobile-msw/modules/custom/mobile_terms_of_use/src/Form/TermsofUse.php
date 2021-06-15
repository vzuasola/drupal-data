<?php

namespace Drupal\mobile_terms_of_use\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * MSW terms of use configuration plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "mobile_terms_of_use",
 *   route = {
 *     "title" = "Terms of Use Configuration",
 *     "path" = "/admin/config/mobile/terms_of_use/configuration",
 *   },
 *   menu = {
 *     "title" = "Terms of Use Configuration",
 *     "description" = "Provides configuration for Terms of Use",
 *     "parent" = "mobile_config.list",
 *   },
 * )
 */

class TermsofUse extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['mobile_terms_of_use.mobile_terms_of_use_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state)
  {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('General Configuration'),
    ];

    $this->termsofUseConfig($form);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  private function termsofUseConfig(array &$form)
  {
    $form['header_setting'] = [
      '#type' => 'details',
      '#title' => t('Header'),
      '#group' => 'advanced',
    ];

    $form['header_setting']['enable_terms_of_use'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Terms of Use - (✓)enable | (✕)disable'),
      '#default_value' => $this->get('enable_terms_of_use'),
      '#translatable' => TRUE,
    ];

    $form['header_setting']['title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#default_value' => $this->get('title'),
      '#translatable' => TRUE,
    ];

    $form['header_setting']['logo'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Logo URL'),
      '#default_value' => $this->get('logo'),
      '#translatable' => TRUE,
    ];

    $form['content_setting'] = [
      '#type' => 'details',
      '#title' => t('Content'),
      '#group' => 'advanced',
    ];

    $body_content = $this->get('content');
    $form['content_setting']['content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Terms of Use Content'),
      '#default_value' => $body_content['value'],
      '#format' => $body_content['format'],
      '#translatable' => TRUE,
    ];

    $form['content_setting']['accept'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Accept'),
      '#default_value' => $this->get('accept'),
      '#translatable' => TRUE,
    ];

    $form['content_setting']['decline'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Decline'),
      '#default_value' => $this->get('decline'),
      '#translatable' => TRUE,
    ];
  }
}
