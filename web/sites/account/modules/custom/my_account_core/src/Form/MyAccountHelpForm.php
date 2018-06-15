<?php

namespace Drupal\my_account_core\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * My Account Help configuration.
 *
 * @WebcomposerConfigPlugin(
 *   id = "my_account_core.help",
 *   route = {
 *     "title" = "My Account Help Configuration",
 *     "path" = "/admin/config/my_account/help",
 *   },
 *   menu = {
 *     "title" = "My Account Help",
 *     "description" = "My account help configuration",
 *     "parent" = "my_account_form_profile.config",
 *   },
 * )
 */
class MyAccountHelpForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['my_account_core.help'];
  }

  /**
   * Build the form.
   *
   * @inheritdoc
   */
  public function form(array $form, FormStateInterface $form_state) {

    $form['help'] = [
      '#type' => 'vertical_tabs',
    ];

    $form['field_configuration'] = [
      '#type' => 'details',
      '#title' => 'Field Configuration',
      '#group' => 'help',
    ];

    $howTo = $this->get('help_how_to');
    $form['field_configuration']['help_how_to'] = [
      '#type' => 'text_format',
      '#title' => t('How To'),
      '#required' => TRUE,
      '#default_value' => $howTo['value'],
      '#format' => $howTo['format'],
      '#translatable' => TRUE,
    ];

    $faq = $this->get('help_faq');
    $form['field_configuration']['help_faq'] = [
      '#type' => 'text_format',
      '#title' => t('FAQ'),
      '#required' => TRUE,
      '#default_value' => $faq['value'],
      '#format' => $faq['format'],
      '#translatable' => TRUE,
    ];

    $errorCode = $this->get('help_error_code');
    $form['field_configuration']['help_error_code'] = [
      '#type' => 'text_format',
      '#title' => t('Error Code'),
      '#required' => TRUE,
      '#default_value' => $errorCode['value'],
      '#format' => $errorCode['format'],
      '#translatable' => TRUE,
    ];

    return $form;
  }

}
