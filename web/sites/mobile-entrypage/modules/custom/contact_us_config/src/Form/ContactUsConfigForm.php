<?php

namespace Drupal\contact_us_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Description form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "contact_us_config",
 *   route = {
 *     "title" = "Contact Us Configuration",
 *     "path" = "/admin/config/webcomposer/config/contact_us_config",
 *   },
 *   menu = {
 *     "title" = "Contact us configuration",
 *     "description" = "Configure Contact us Blurb, Success Page and Email Template",
 *     "parent" = "contact_us_config.list",
 *     "weight" = 30
 *   },
 * )
 */
class ContactUsConfigForm extends FormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['contact_us_config.contact_us_configuration'];
  }

  /**
   * {@inheritdoc}
   */
  public function form(array $form, FormStateInterface $form_state) {

    $form['advanced'] = [
      '#type' => 'vertical_tabs',
    ];

    $this->contactBlurb($form);
    $this->contactSuccess($form);
    $this->contactSettings($form);

    return $form;
  }

  /**
   *
   */
  private function contactBlurb(array &$form) {
    $form['content'] = [
      '#type' => 'details',
      '#title' => t('Contact Us Blurb'),
      '#group' => 'advanced',
    ];

    $form['content']['page_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#description' => $this->t('Adds page title to the contact us page.'),
      '#default_value' => $this->get('page_title'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['background_config']['file_image_page_image'] = [
      '#type' => 'managed_file',
      '#title' => $this->t('Image'),
      '#description' => $this->t('Adds page image to the contact us page.'),
      '#default_value' => $this->get('file_image_page_image'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['gif png jpg jpeg'],
      ],
    ];

    $body_content = $this->get('body_content');
    $form['content']['body_content'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Content Blurb'),
      '#default_value' => $body_content['value'],
      '#format' => $body_content['format'],
      '#translatable' => TRUE,
    ];
  }

  /**
   *
   */
  private function contactSuccess(array &$form) {
    $form['success'] = [
      '#type' => 'details',
      '#title' => t('Contact Us Success Page'),
      '#group' => 'advanced',
    ];

    $form['success']['success_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#description' => $this->t('Adds page title to the contact us success message.'),
      '#default_value' => $this->get('success_title'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $success_message = $this->get('success_message');
    $form['success']['success_message'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Content Blurb'),
      '#default_value' => $success_message['value'],
      '#format' => $success_message['format'],
      '#translatable' => TRUE,
    ];
  }

  /**
   *
   */
  private function contactSettings(array &$form) {
    $form['settings'] = [
      '#type' => 'details',
      '#title' => t('Contact Us Form Settings'),
      '#group' => 'advanced',
    ];

    $form['settings']['form_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Title'),
      '#description' => $this->t('Adds page title to the contact us form.'),
      '#default_value' => $this->get('form_title'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];

    $form['settings']['email_template'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Email Template'),
      '#default_value' => $this->get('email_template'),
      '#rows' => 15,
      '#description' => 'Tokens:
      <ul>
          <li>@firstname - First name of the player</li>
          <li>@lastname - Last name of the player</li>
          <li>@username - Username of the player</li>
          <li>@email - Email Address the player inputted</li>
          <li>@product - Product the player selected</li>
          <li>@subject - Subject the player selected</li>
          <li>@message - Main message of the player</li>
          <li>@date - This date the form is submitted</li>
          <li>@ip - IP address of the player</li>
          <li>@language - Selected language of the player</li>
      </ul>',
      '#translatable' => TRUE,
    ];

    $form['settings']['from_email'] = [
      '#type' => 'textfield',
      '#title' => $this->t('From Email'),
      '#description' => $this->t('Adds froms email while sending contact us form.'),
      '#default_value' => $this->get('from_email'),
      '#required' => TRUE,
      '#translatable' => TRUE,
    ];
  }
}
