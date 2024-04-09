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
 *     "weight" = 40
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
    $this->sectionBannerConfig($form);
    $this->sectionSuccessPageConfig($form);
    $this->sectionSignupDataConfig($form);

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
  }

  private function sectionBannerConfig(array &$form) {
    $form['banner_config'] = [
      '#type' => 'details',
      '#title' => t('Banner Configuration'),
      '#group' => 'advanced',
    ];

    $form['banner_config']['desktop_banner_ja'] = [
      '#type' => 'fieldset',
      '#title' => t('Singin Desktop Banner - JA')
    ];

    $form['banner_config']['desktop_banner_ja']['file_image_desktop_banner_ja'] = [
      '#type' => 'managed_file',
      '#title' => t('Signin Desktop Left Banner JA'),
      '#description' => t('Upload a file, allowed extensions: jpg, jpeg, png, gif'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['png jpg jpeg gif'],
      ],
      '#default_value' => $this->get('file_image_desktop_banner_ja'),
    ];

   $form['banner_config']['desktop_banner_ja']['desktop_banner_alt_text_ja'] = [
      '#type' => 'textfield',
      '#title' => t('Alternative text'),
      '#default_value' => $this->get('desktop_banner_alt_text_ja'),
    ];

    $form['banner_config']['desktop_banner_en'] = [
      '#type' => 'fieldset',
      '#title' => t('Singin Desktop Banner - EN')
    ];

    $form['banner_config']['desktop_banner_en']['file_image_desktop_banner_en'] = [
      '#type' => 'managed_file',
      '#title' => t('Signin Desktop Left Banner EN'),
      '#description' => t('Upload a file, allowed extensions: jpg, jpeg, png, gif'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['png jpg jpeg gif'],
      ],
      '#default_value' => $this->get('file_image_desktop_banner_en'),
    ];

   $form['banner_config']['desktop_banner_en']['desktop_banner_alt_text_en'] = [
      '#type' => 'textfield',
      '#title' => t('Alternative text'),
      '#default_value' => $this->get('desktop_banner_alt_text_en'),
    ];
    // Mobile Banner
    $form['banner_config']['mobile_banner_ja'] = [
      '#type' => 'fieldset',
      '#title' => t('Singin Mobile Banner - JA')
    ];

    $form['banner_config']['mobile_banner_ja']['file_image_mobile_banner_ja'] = [
      '#type' => 'managed_file',
      '#title' => t('Signin Mobile Left Banner JA'),
      '#description' => t('Upload a file, allowed extensions: jpg, jpeg, png, gif'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['png jpg jpeg gif'],
      ],
      '#default_value' => $this->get('file_image_mobile_banner_ja'),
    ];

   $form['banner_config']['mobile_banner_ja']['mobile_banner_alt_text_ja'] = [
      '#type' => 'textfield',
      '#title' => t('Alternative text'),
      '#default_value' => $this->get('mobile_banner_alt_text_ja'),
    ];

    $form['banner_config']['mobile_banner_en'] = [
      '#type' => 'fieldset',
      '#title' => t('Singin Mobile Banner - EN')
    ];

    $form['banner_config']['mobile_banner_en']['file_image_mobile_banner_en'] = [
      '#type' => 'managed_file',
      '#title' => t('Signin Mobile Left Banner EN'),
      '#description' => t('Upload a file, allowed extensions: jpg, jpeg, png, gif'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['png jpg jpeg gif'],
      ],
      '#default_value' => $this->get('file_image_mobile_banner_en'),
    ];

   $form['banner_config']['mobile_banner_en']['mobile_banner_alt_text_en'] = [
      '#type' => 'textfield',
      '#title' => t('Alternative text'),
      '#default_value' => $this->get('mobile_banner_alt_text_en'),
    ];
  }

  private function sectionSignupDataConfig(array &$form) {
    $form['signup_data_config'] = [
      '#type' => 'details',
      '#title' => t('SignUp Default Data Configuration'),
      '#group' => 'advanced',
    ];

    $form['signup_data_config']['signup_firstname_default_value'] = [
      '#type' => 'textfield',
      '#title' => $this->t('First Name Default Value'),
      '#default_value' => $this->get('signup_firstname_default_value'),
      '#translatable' => TRUE,
    ];

    $form['signup_data_config']['signup_lastname_default_value'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Last Name Default Value'),
      '#default_value' => $this->get('signup_lastname_default_value'),
      '#translatable' => TRUE,
    ];

    $form['signup_data_config']['signup_gender_default_value'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Gender Default Value'),
      '#default_value' => $this->get('signup_gender_default_value'),
      '#translatable' => TRUE,
    ];

    $form['signup_data_config']['signup_day_default_value'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Birth Day Default Value'),
      '#default_value' => $this->get('signup_day_default_value'),
      '#translatable' => TRUE,
    ];

    $form['signup_data_config']['signup_month_default_value'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Birth Month Default Value'),
      '#default_value' => $this->get('signup_month_default_value'),
      '#translatable' => TRUE,
    ];

    $form['signup_data_config']['signup_year_default_value'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Birth Year Default Value'),
      '#default_value' => $this->get('signup_year_default_value'),
      '#translatable' => TRUE,
    ];

    $form['signup_data_config']['signup_phonenum_default_value'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Phone Number Default Value'),
      '#default_value' => $this->get('signup_phonenum_default_value'),
      '#translatable' => TRUE,
    ];

    $form['signup_data_config']['signup_country_default_value'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Country Default Value'),
      '#default_value' => $this->get('signup_country_default_value'),
      '#translatable' => TRUE,
    ];

    $form['signup_data_config']['signup_zip_default_value'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Zip/Postal Code Default Value'),
      '#default_value' => $this->get('signup_zip_default_value'),
      '#translatable' => TRUE,
    ];

    $form['signup_data_config']['signup_state_default_value'] = [
      '#type' => 'textfield',
      '#title' => $this->t('State/Province Default Value'),
      '#default_value' => $this->get('signup_state_default_value'),
      '#translatable' => TRUE,
    ];

    $form['signup_data_config']['signup_city_default_value'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Town/City Default Value'),
      '#default_value' => $this->get('signup_city_default_value'),
      '#translatable' => TRUE,
    ];

    $form['signup_data_config']['signup_housenum_default_value'] = [
      '#type' => 'textfield',
      '#title' => $this->t('House Name/Number Default Value'),
      '#default_value' => $this->get('signup_housenum_default_value'),
      '#translatable' => TRUE,
    ];
  }

  private function sectionSuccessPageConfig(array &$form) {
    $form['signup_success_page'] = [
      '#type' => 'details',
      '#title' => t('SignUp Success Page'),
      '#group' => 'advanced',
    ];

    $form['signup_success_page']['complete_logo'] = [
      '#type' => 'fieldset',
      '#title' => t('Complete Logo')
    ];

    $form['signup_success_page']['complete_logo']['file_image_complete_logo'] = [
      '#type' => 'managed_file',
      '#title' => t('Complete Logo'),
      '#description' => t('Upload a file, allowed extensions: jpg, jpeg, png, gif'),
      '#upload_location' => 'public://',
      '#upload_validators' => [
        'file_validate_extensions' => ['png jpg jpeg gif'],
      ],
      '#default_value' => $this->get('file_image_complete_logo'),
    ];

   $form['signup_success_page']['complete_logo']['file_image_complete_logo_alt_text'] = [
      '#type' => 'textfield',
      '#title' => t('Alternative text'),
      '#default_value' => $this->get('file_image_complete_logo_alt_text'),
    ];

    $form['signup_success_page']['success_page_deposit_bonus_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Deposit Bonus Title'),
      '#default_value' => $this->get('success_page_deposit_bonus_title'),
      '#translatable' => TRUE,
    ];

    $d = $this->get('deposit_bonus_banner');
    $form['signup_success_page']['deposit_bonus_banner'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Deposit Bonus Banner'),
      '#default_value' => $d['value'],
      '#format' => $d['format'],
      '#translatable' => TRUE,
    ];

    $form['signup_success_page']['deposit_bonus_instruction_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Deposit Bonus Instruction Title'),
      '#default_value' => $this->get('deposit_bonus_instruction_title'),
      '#translatable' => TRUE,
    ];

    $d = $this->get('deposit_bonus_instruction');
    $form['signup_success_page']['deposit_bonus_instruction'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Deposit Bonus Instructions'),
      '#default_value' => $d['value'],
      '#format' => $d['format'],
      '#translatable' => TRUE,
    ];

    $form['signup_success_page']['game_information_title'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Game Information Title'),
      '#default_value' => $this->get('game_information_title'),
      '#translatable' => TRUE,
    ];

    $d = $this->get('game_information_body');
    $form['signup_success_page']['game_information_body'] = [
      '#type' => 'text_format',
      '#title' => $this->t('Game Information Content'),
      '#default_value' => $d['value'],
      '#format' => $d['format'],
      '#translatable' => TRUE,
    ];

    $form['signup_success_page']['all_games_text'] = [
      '#type' => 'textfield',
      '#title' => $this->t('All Games Text'),
      '#default_value' => $this->get('all_games_text'),
      '#translatable' => TRUE,
    ];

    $form['signup_success_page']['all_games_link'] = [
      '#type' => 'textfield',
      '#title' => $this->t('All Games Link'),
      '#default_value' => $this->get('all_games_link'),
      '#translatable' => TRUE,
    ];
  }
}
