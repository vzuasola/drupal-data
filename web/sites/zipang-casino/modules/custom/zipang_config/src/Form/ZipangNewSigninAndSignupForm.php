<?php

namespace Drupal\zipang_config\Form;

use Drupal\webcomposer_config_schema\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\file\Entity\File;


/**
 * My module form plugin
 *
 * @WebcomposerConfigPlugin(
 *   id = "signin_and_signup",
 *   route = {
 *     "title" = "New Sign in and Sign up Configuration",
 *     "path" = "/admin/config/zipang/signin_and_signup_config",
 *   },
 *   menu = {
 *     "title" = "New Sign in and Sign up Configuration",
 *     "description" = "Provides New Sign in and Sign up Configuration",
 *     "parent" = "zipang_config.zipang_config",
 *     "weight" = 30
 *   },
 * )
 */
class ZipangNewSigninAndSignupForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['zipang_config.signin_and_signup_config'];
  }

  public function form(array $form, FormStateInterface $form_state) {
    $form['advanced'] = [
      '#type' => 'vertical_tabs',
      '#title' => t('Sign in and Sign up Configuration'),
    ];

    $this->sectionSigninAndSignup($form);

    return $form;
  }

  private function sectionSigninAndSignup(array &$form) {

    $form['signin_and_signup'] = [
      '#type' => 'details',
      '#title' => t('Sign in and Sign up'),
      '#group' => 'advanced',
    ];

    $form['signin_and_signup']['enable_new_signin'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('<b>Enable new Sign in and Sign up form</b>'),
      '#description' => $this->t('Enable new Sign in and Sign up form. If checked value is "Enabled".'),
      '#default_value' => $this->get('enable_new_signin'),
      '#translatable' => TRUE,
    ];

    $form['signin_and_signup']['signin_tab_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Signin Tab text'),
      '#default_value' => $this->get('signin_tab_text'),
      '#description' => $this->t('Text display on Signin tab'),
      '#translatable' => TRUE,
    ];

    $form['signin_and_signup']['signup_tab_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Signup Tab text'),
      '#default_value' => $this->get('signup_tab_text'),
      '#description' => $this->t('Text display on Signup tab'),
      '#translatable' => TRUE,
    ];

    $form['signin_and_signup']['desktop_banner_en'] = [
      '#type' => 'fieldset',
      '#title' => t('Desktop Banner - EN'),
    ];
    $config = $this->config('zipang_config.signin_and_signup_config');
    $form['signin_and_signup']['desktop_banner_en']['file_desktop_banner_en'] = [
      '#type' => 'managed_file',
      '#title' => t('Desktop Left Banner Image EN'),
      '#description' => t('Upload a file, allowed extensions: jpg, jpeg, png, gif'),
      '#upload_location' => 'public://upload',
      '#upload_validators' => [
        'file_validate_extensions' => ['png jpg jpeg gif'],
      ],
      '#default_value' => $config->get('file_desktop_banner_en'),
    ];

    $form['signin_and_signup']['desktop_banner_en']['desktop_banner_alt_text_en'] = [
      '#type' => 'textfield',
      '#title' => t('Alternative text'),
      '#default_value' => $this->get('desktop_banner_alt_text_en'),
    ];

    $form['signin_and_signup']['desktop_banner_ja'] = [
      '#type' => 'fieldset',
      '#title' => t('Desktop Banner - JA'),
    ];

    $form['signin_and_signup']['desktop_banner_ja']['file_desktop_banner_ja'] = [
      '#type' => 'managed_file',
      '#title' => t('Desktop Left Banner JA'),
      '#description' => t('Upload a file, allowed extensions: jpg, jpeg, png, gif'),
      '#upload_location' => 'public://upload',
      '#upload_validators' => [
        'file_validate_extensions' => ['png jpg jpeg gif'],
      ],
      '#default_value' => $config->get('file_desktop_banner_ja'),
    ];

    $form['signin_and_signup']['desktop_banner_ja']['desktop_banner_alt_text_ja'] = [
      '#type' => 'textfield',
      '#title' => t('Alternative text'),
      '#default_value' => $this->get('desktop_banner_alt_text_ja'),
    ];
  }
}
