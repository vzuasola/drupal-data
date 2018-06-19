<?php

namespace Drupal\contact_form\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Description form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "contact_form_settings",
 *   route = {
 *     "title" = "Contact us settings",
 *     "path" = "/admin/config/contact-us/settings",
 *   },
 *   menu = {
 *     "title" = "Contact us settings",
 *     "description" = "Configure contact us form settings",
 *     "parent" = "contact_form.list",
 *     "weight" = 30
 *   },
 * )
 */
class ContactUsSettingsForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['contact_form.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {

    $form['advanced'] = array(
      '#type' => 'vertical_tabs',
    );

    $form['settings'] = array(
      '#type' => 'details',
      '#title' => t('Submit Settings'),
      '#group' => 'advanced',
    );

    $form['settings']['email_template'] = array(
        '#type' => 'textarea',
        '#title' => $this->t('Email Template'),
        '#default_value' => $this->get('email_template'),
        '#rows' => 15,
        '#description' => 'Tokens:
        <ul>
            <li>[-firstname-] - First name of the player</li>
            <li>[-lastname-] - Last name of the player</li>
            <li>[-username-] - Username of the player</li>
            <li>[-email-] - Email Address the player inputted (for post login this is automatic)</li>
            <li>[-product-] - Product the player selected</li>
            <li>[-subject-] - Subject the player selected</li>
            <li>[-message-] - Main message of the player</li>
            <li>[-submissiondate-] - This will use the "long" format</li>
            <li>[-ip_address-] - IP address of the player</li>
        </ul>'
    );

    $form['settings']['email_from'] = array(
        '#type' => 'textfield',
        '#title' => t('Email from'),
        '#default_value' => $this->get('email_from'),
        '#description' => 'The "Sender" of the email. This will default to the users Firstname and Last Name'
    );
    $form['settings']['generic_error'] = array(
        '#type' => 'textarea',
        '#title' => t('Generic Error template'),
        '#default_value' => $this->get('generic_error'),
        '#description' => 'This will be used as the generic error message for any system errors that may be encountered.',
        '#rows' => 3
    );
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function submit(array &$form, FormStateInterface $form_state) {
    $keys = [
      'email_template',
      'email_from',
      'generic_error'
    ];

    foreach ($keys as $key) {
      $data[$key] = $form_state->getValue($key);
    }

    $this->save($data);
  }
}
