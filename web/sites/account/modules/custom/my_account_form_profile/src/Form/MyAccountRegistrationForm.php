<?php

namespace Drupal\my_account_form_profile\Form;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Path\AliasManagerInterface;
use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Path\PathValidatorInterface;
use Drupal\Core\Routing\RequestContext;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Implements the vertical tabs demo form controller.
 *
 * This example demonstrates the use of \Drupal\Core\Render\Element\VerticalTabs
 * to group input elements according category.
 *
 * @see \Drupal\Core\Form\FormBase
 * @see \Drupal\Core\Form\ConfigFormBase
 */
class MyAccountRegistrationForm extends ConfigFormBase
{

    /**
     * Build the form.
     *
     * @inheritdoc
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {
        // Get Form configuration.
        $myAccountConfig = $this->config('my_account_form_profile.profile');
        $myAccountConfigValue = $myAccountConfig->get();
        $form['profile'] = [
            '#type' => 'vertical_tabs',
        ];

        $form['field_configuration'] = [
            '#type' => 'details',
            '#title' => 'Field Configuration',
            '#group' => 'profile',
            '#open' => TRUE,
            '#tree' => TRUE,
        ];
        $form['field_configuration']['field_labels_user_name'] = [
            '#type' => 'details',
            '#title' => 'Username',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_user_name']['label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Label'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the username Field.'),
            '#default_value' => $myAccountConfigValue['username_field']['options']['label'],
        ];

        $form['field_configuration']['field_labels_user_name']['placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Placeholder'),
            '#size' => 25,
            '#description' => $this->t('Placeholder for the username Field.'),
            '#default_value' => $myAccountConfigValue['username_field']['options']['attr']['placeholder'],
        ];

        $form['field_configuration']['field_labels_user_name']['weight'] = [
            '#type' => 'select',
            '#title' => $this->t('Field weight'),
            '#disabled' => TRUE,
            '#options' => ['0' => '0'],
            '#default_value' => $myAccountConfigValue['username_field']['weight'],
        ];

        $form['field_configuration']['field_labels_user_name']['wrapper_class'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Username wrapper'),
            '#size' => 25,
            '#description' => $this->t('Wrapper class for field.'),
            '#default_value' => $myAccountConfigValue['username_field']['options']['wrapper_class'],
        ];

        $form['field_configuration']['field_labels_user_name']['enable_tooltip'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Enable Tooltip'),
            '#required' => FALSE,
            '#default_value' => $myAccountConfigValue['username_field']['options']['attr']['enable_tooltip'],
        ];

        $form['field_configuration']['field_labels_user_name']['tooltip_blurb'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Tooltip Blurb'),
            '#required' => FALSE,
            '#default_value' => $myAccountConfigValue['username_field']['options']['attr']['tooltip_blurb'],
        ];

        $form['field_configuration']['field_labels_currency'] = [
            '#type' => 'details',
            '#title' => 'Currency',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_currency']['label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Label'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the currency Field.'),
            '#default_value' => $myAccountConfigValue['currency_field']['options']['label'],
        ];

        $form['field_configuration']['field_labels_currency']['placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Placeholder'),
            '#size' => 25,
            '#description' => $this->t('Placeholder for the currency Field.'),
            '#default_value' => $myAccountConfigValue['currency_field']['options']['attr']['placeholder'],
        ];

        $form['field_configuration']['field_labels_currency']['error'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Error message for currency'),
            '#size' => 100,
            '#default_value' => $myAccountConfigValue['currency_field']['options']['error'],
        ];

        $form['field_configuration']['field_labels_currency']['weight'] = [
            '#type' => 'select',
            '#title' => $this->t('Field Weight'),
            '#disabled' => TRUE,
            '#options' => ['1' => '1'],
            '#default_value' => $myAccountConfigValue['currency_field']['weight'],
        ];

        $form['field_configuration']['field_labels_currency']['wrapper_class'] = [
            '#type' => 'textfield',
            '#title' => $this->t('wrapper class'),
            '#size' => 25,
            '#description' => $this->t('Wrapper class for field.'),
            '#default_value' => $myAccountConfigValue['currency_field']['options']['wrapper_class'],
        ];

        $form['field_configuration']['field_labels_currency']['enable_tooltip'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Enable Tooltip'),
            '#required' => FALSE,
            '#default_value' => $myAccountConfigValue['currency_field']['options']['attr']['enable_tooltip'],
        ];

        $form['field_configuration']['field_labels_currency']['tooltip_blurb'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Tooltip Blurb'),
            '#required' => FALSE,
            '#default_value' => $myAccountConfigValue['currency_field']['options']['attr']['tooltip_blurb'],
        ];

        $form['field_configuration']['field_labels_first_name'] = [
            '#type' => 'details',
            '#title' => 'First Name',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_first_name']['label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Label'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the first name Field.'),
            '#default_value' => $myAccountConfigValue['first_name_field']['options']['label'],
        ];

        $form['field_configuration']['field_labels_first_name']['placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Placeholder'),
            '#size' => 25,
            '#description' => $this->t('Placeholder for the first name Field.'),
            '#default_value' => $myAccountConfigValue['first_name_field']['options']['attr']['placeholder'],
        ];

        $form['field_configuration']['field_labels_first_name']['error'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Error message for First name'),
            '#size' => 100,
            '#default_value' => $myAccountConfigValue['first_name_field']['options']['error'],
        ];

        $form['field_configuration']['field_labels_first_name']['weight'] = [
            '#type' => 'select',
            '#title' => $this->t('Field Weight'),
            '#options' => [
                '2' => '2',
                '3' => '3',
            ],
            '#default_value' => $myAccountConfigValue['first_name_field']['weight'],
        ];

        $form['field_configuration']['field_labels_first_name']['wrapper_class'] = [
            '#type' => 'textfield',
            '#title' => $this->t('First name wrapper class'),
            '#size' => 25,
            '#description' => $this->t('Wrapper class for field.'),
            '#default_value' => $myAccountConfigValue['first_name_field']['options']['wrapper_class'],
        ];

        $form['field_configuration']['field_labels_first_name']['enable_tooltip'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Enable Tooltip'),
            '#required' => FALSE,
            '#default_value' => $myAccountConfigValue['first_name_field']['options']['attr']['enable_tooltip'],
        ];

        $form['field_configuration']['field_labels_first_name']['tooltip_blurb'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Tooltip Blurb'),
            '#required' => FALSE,
            '#default_value' => $myAccountConfigValue['first_name_field']['options']['attr']['tooltip_blurb'],
        ];

        $form['field_configuration']['field_labels_last_name'] = [
            '#type' => 'details',
            '#title' => 'Last Name',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_last_name']['label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Label'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the last name Field.'),
            '#default_value' => $myAccountConfigValue['last_name_field']['options']['label'],
        ];

        $form['field_configuration']['field_labels_last_name']['placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Placeholder'),
            '#size' => 25,
            '#description' => $this->t('Placeholder for the last name Field.'),
            '#default_value' => $myAccountConfigValue['last_name_field']['options']['attr']['placeholder'],
        ];

        $form['field_configuration']['field_labels_last_name']['error'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Error message for Last name'),
            '#size' => 100,
            '#default_value' => $myAccountConfigValue['last_name_field']['options']['error'],
        ];

        $form['field_configuration']['field_labels_last_name']['weight'] = [
            '#type' => 'select',
            '#title' => $this->t('Field Weight'),
            '#options' => [
                '2' => '2',
                '3' => '3',
            ],
            '#default_value' => $myAccountConfigValue['last_name_field']['weight'],
        ];

        $form['field_configuration']['field_labels_last_name']['wrapper_class'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Last name wrapper class'),
            '#size' => 25,
            '#description' => $this->t('Wrapper class for field.'),
            '#default_value' => $myAccountConfigValue['last_name_field']['options']['wrapper_class'],
        ];

        $form['field_configuration']['field_labels_last_name']['enable_tooltip'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Enable Tooltip'),
            '#required' => FALSE,
            '#default_value' => $myAccountConfigValue['last_name_field']['options']['attr']['enable_tooltip'],
        ];

        $form['field_configuration']['field_labels_last_name']['tooltip_blurb'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Tooltip Blurb'),
            '#required' => FALSE,
            '#default_value' => $myAccountConfigValue['last_name_field']['options']['attr']['tooltip_blurb'],
        ];

        $form['field_configuration']['field_labels_dob'] = [
            '#type' => 'details',
            '#title' => 'DOB',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_dob']['label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Label'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the DOB Field.'),
            '#default_value' => $myAccountConfigValue['dob_field']['options']['label'],
        ];

        $form['field_configuration']['field_labels_dob']['error'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Error message for DOB'),
            '#size' => 100,
            '#default_value' => $myAccountConfigValue['dob_field']['options']['error'],
        ];

        $form['field_configuration']['field_labels_dob']['weight'] = [
            '#type' => 'select',
            '#title' => $this->t('Field Weight'),
            '#disabled' => TRUE,
            '#options' => ['4' => '4'],
            '#default_value' => $myAccountConfigValue['dob_field']['weight'],
        ];

        $form['field_configuration']['field_labels_dob']['wrapper_class'] = [
            '#type' => 'textfield',
            '#title' => $this->t('DOB wrapper class'),
            '#size' => 25,
            '#description' => $this->t('Wrapper class for field.'),
            '#default_value' => $myAccountConfigValue['dob_field']['options']['wrapper_class'],
        ];
        $form['field_configuration']['field_labels_dob']['field_labels_dob_month'] = [
            '#type' => 'details',
            '#title' => 'DOB Month',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_dob']['field_labels_dob_month']['weight'] = [
            '#type' => 'select',
            '#title' => $this->t('DOB Month Field Weight'),
            '#options' => [
                '5' => '5',
                '6' => '6',
                '7' => '7',
            ],
            '#default_value' => $myAccountConfigValue['dob_month']['weight'],
        ];

        $form['field_configuration']['field_labels_dob']['enable_tooltip'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Enable Tooltip'),
            '#required' => FALSE,
            '#default_value' => $myAccountConfigValue['dob_field']['options']['attr']['enable_tooltip'],
        ];

        $form['field_configuration']['field_labels_dob']['tooltip_blurb'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Tooltip Blurb'),
            '#required' => FALSE,
            '#default_value' => $myAccountConfigValue['dob_field']['options']['attr']['tooltip_blurb'],
        ];

        $form['field_configuration']['field_labels_dob']['field_labels_dob_month']['wrapper_class'] = [
            '#type' => 'textfield',
            '#title' => $this->t('DOB Month wrapper class'),
            '#size' => 25,
            '#description' => $this->t('Wrapper class for field.'),
            '#default_value' => $myAccountConfigValue['dob_month']['options']['wrapper_class'],
        ];

        $form['field_configuration']['field_labels_dob']['field_labels_dob_day'] = [
            '#type' => 'details',
            '#title' => 'DOB Day',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_dob']['field_labels_dob_day']['weight'] = [
            '#type' => 'select',
            '#title' => $this->t('DOB Day Field Weight'),
            '#options' => [
                '5' => '5',
                '6' => '6',
                '7' => '7',
            ],
            '#default_value' => $myAccountConfigValue['dob_day']['weight'],
        ];

        $form['field_configuration']['field_labels_dob']['field_labels_dob_day']['wrapper_class'] = [
            '#type' => 'textfield',
            '#title' => $this->t('DOB Day wrapper class'),
            '#size' => 25,
            '#description' => $this->t('Wrapper class for field.'),
            '#default_value' => $myAccountConfigValue['dob_day']['options']['wrapper_class'],
        ];
        $form['field_configuration']['field_labels_dob']['field_labels_dob_year'] = [
            '#type' => 'details',
            '#title' => 'DOB Year',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_dob']['field_labels_dob_year']['weight'] = [
            '#type' => 'select',
            '#title' => $this->t('DOB Year Field Weight'),
            '#options' => [
                '5' => '5',
                '6' => '6',
                '7' => '7',
            ],
            '#default_value' => $myAccountConfigValue['dob_year']['weight'],
        ];

        $form['field_configuration']['field_labels_dob']['field_labels_dob_year']['wrapper_class'] = [
            '#type' => 'textfield',
            '#title' => $this->t('DOB Year wrapper class'),
            '#size' => 25,
            '#description' => $this->t('Wrapper class for field.'),
            '#default_value' => $myAccountConfigValue['dob_year']['options']['wrapper_class'],
        ];

        $form['field_configuration']['field_labels_country'] = [
            '#type' => 'details',
            '#title' => 'Country',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_country']['label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Label'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the country Field.'),
            '#default_value' => $myAccountConfigValue['country_field']['options']['label'],
        ];

        $form['field_configuration']['field_labels_country']['placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Placeholder'),
            '#size' => 25,
            '#description' => $this->t('Placeholder for the country Field.'),
            '#default_value' => $myAccountConfigValue['country_field']['options']['attr']['placeholder'],
        ];

        $form['field_configuration']['field_labels_country']['error'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Error message for Country'),
            '#size' => 100,
            '#default_value' => $myAccountConfigValue['country_field']['options']['error'],
        ];

        $form['field_configuration']['field_labels_country']['weight'] = [
            '#type' => 'select',
            '#title' => $this->t('Field Weight'),
            '#disabled' => TRUE,
            '#options' => ['9' => '9'],
            '#default_value' => '9',
        ];

        $form['field_configuration']['field_labels_country']['wrapper_class'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Country wrapper class'),
            '#size' => 25,
            '#description' => $this->t('Wrapper class for field.'),
            '#default_value' => $myAccountConfigValue['country_field']['options']['wrapper_class'],
        ];

        $form['field_configuration']['field_labels_country']['enable_tooltip'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Enable Tooltip'),
            '#required' => FALSE,
            '#default_value' => $myAccountConfigValue['country_field']['options']['attr']['enable_tooltip'],
        ];

        $form['field_configuration']['field_labels_country']['tooltip_blurb'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Tooltip Blurb'),
            '#required' => FALSE,
            '#default_value' => $myAccountConfigValue['country_field']['options']['attr']['tooltip_blurb'],
        ];

        $form['field_configuration']['field_labels_email'] = [
            '#type' => 'details',
            '#title' => 'Email',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_email']['label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Label'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the email Field.'),
            '#default_value' => $myAccountConfigValue['email_field']['options']['label'],
        ];

        $form['field_configuration']['field_labels_email']['placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Placeholder'),
            '#size' => 25,
            '#description' => $this->t('Placeholder for the email Field.'),
            '#default_value' => $myAccountConfigValue['email_field']['options']['attr']['placeholder'],
        ];

        $form['field_configuration']['field_labels_email']['error'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Error message for Email'),
            '#size' => 100,
            '#default_value' => $myAccountConfigValue['email_field']['options']['error'],
        ];

        $form['field_configuration']['field_labels_email']['weight'] = [
            '#type' => 'select',
            '#title' => $this->t('Field Weight'),
            '#disabled' => TRUE,
            '#options' => ['8' => '8'],
            '#default_value' => '8',
        ];

        $form['field_configuration']['field_labels_email']['wrapper_class'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Email wrapper class'),
            '#size' => 25,
            '#description' => $this->t('Wrapper class for field.'),
            '#default_value' => $myAccountConfigValue['email_field']['options']['wrapper_class'],
        ];

        $form['field_configuration']['field_labels_email']['enable_tooltip'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Enable Tooltip'),
            '#required' => FALSE,
            '#default_value' => $myAccountConfigValue['email_field']['options']['attr']['enable_tooltip'],
        ];

        $form['field_configuration']['field_labels_email']['tooltip_blurb'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Tooltip Blurb'),
            '#required' => FALSE,
            '#default_value' => $myAccountConfigValue['email_field']['options']['attr']['tooltip_blurb'],
        ];

        $form['field_configuration']['field_labels_gender'] = [
            '#type' => 'details',
            '#title' => 'Gender',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_gender']['label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Label'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the Gender Field.'),
            '#default_value' => $myAccountConfigValue['gender_field']['options']['label'],
        ];

        $form['field_configuration']['field_labels_gender']['weight'] = [
            '#type' => 'select',
            '#title' => $this->t('Field weight'),
            '#disabled' => TRUE,
            '#options' => ['10' => '10'],
            '#default_value' => '10',
        ];

        $form['field_configuration']['field_labels_gender']['wrapper_class'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Gender wrapper'),
            '#size' => 25,
            '#description' => $this->t('Wrapper class for field.'),
            '#default_value' => $myAccountConfigValue['gender_field']['options']['wrapper_class'],
        ];

        $form['field_configuration']['field_labels_gender']['enable_tooltip'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Enable Tooltip'),
            '#required' => FALSE,
            '#default_value' => $myAccountConfigValue['gender_field']['options']['attr']['enable_tooltip'],
        ];

        $form['field_configuration']['field_labels_gender']['tooltip_blurb'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Tooltip Blurb'),
            '#required' => FALSE,
            '#default_value' => $myAccountConfigValue['gender_field']['options']['attr']['tooltip_blurb'],
        ];

        $form['field_configuration']['field_labels_mobile_number'] = [
            '#type' => 'details',
            '#title' => 'Mobile Number',
            '#open' => false,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_mobile_number']['label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Label'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the mobile number Field.'),
            '#default_value' => $myAccountConfigValue['mobile_number_field']['options']['label'],
        ];

        $form['field_configuration']['field_labels_mobile_number']['placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Placeholder'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Placeholder for the mobile number Field.'),
            '#default_value' => $myAccountConfigValue['mobile_number_field']['options']['attr']['placeholder'],
        ];

        $form['field_configuration']['field_labels_mobile_number']['weight'] = [
            '#type' => 'select',
            '#title' => $this->t('Field Weight'),
            '#disabled' => TRUE,
            '#options' => ['11' => '11'],
            '#default_value' => $myAccountConfigValue['mobile_number_field']['weight'],
        ];

        $form['field_configuration']['field_labels_mobile_number']['wrapper_class'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Mobile no. wrapper class'),
            '#size' => 25,
            '#description' => $this->t('Wrapper class for field.'),
            '#default_value' => $myAccountConfigValue['mobile_number_field']['options']['wrapper_class'],
        ];

        $form['field_configuration']['field_labels_mobile_number']['enable_tooltip'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Enable Tooltip'),
            '#required' => FALSE,
            '#default_value' => $myAccountConfigValue['mobile_number_field']['options']['attr']['enable_tooltip'],
        ];

        $form['field_configuration']['field_labels_mobile_number']['tooltip_blurb'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Tooltip Blurb'),
            '#required' => FALSE,
            '#default_value' => $myAccountConfigValue['mobile_number_field']['options']['attr']['tooltip_blurb'],
        ];

        $form['field_configuration']['field_labels_mobile_number_1'] = [
            '#type' => 'details',
            '#title' => 'Mobile Number 1',
            '#open' => false,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_mobile_number_1']['label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Label'),
            '#size' => 25,
            '#required' => FALSE,
            '#description' => $this->t('Label for the mobile number 1 Field.'),
            '#default_value' => $myAccountConfigValue['mobile_number_1_field']['options']['label'],
        ];

        $form['field_configuration']['field_labels_mobile_number_1']['placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Placeholder'),
            '#size' => 25,
            '#required' => FALSE,
            '#description' => $this->t('Placeholder for the mobile number Field.'),
            '#default_value' => $myAccountConfigValue['mobile_number_1_field']['options']['attr']['placeholder'],
        ];

        $form['field_configuration']['field_labels_mobile_number_1']['weight'] = [
            '#type' => 'select',
            '#title' => $this->t('Field Weight'),
            '#disabled' => TRUE,
            '#options' => ['12' => '12'],
            '#default_value' => '12',
        ];

        $form['field_configuration']['field_labels_mobile_number_1']['wrapper_class'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Mobile no. wrapper class'),
            '#size' => 25,
            '#description' => $this->t('Wrapper class for field.'),
            '#default_value' => $myAccountConfigValue['mobile_number_1_field']['options']['wrapper_class'],
        ];

        $form['field_configuration']['field_labels_language'] = [
            '#type' => 'details',
            '#title' => 'Language',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_language']['label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Label'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the language Field.'),
            '#default_value' => $myAccountConfigValue['language_field']['options']['label'],
        ];

        $form['field_configuration']['field_labels_language']['placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Placeholder'),
            '#size' => 25,
            '#description' => $this->t('Placeholder for the language Field.'),
            '#default_value' => $myAccountConfigValue['language_field']['options']['attr']['placeholder'],
        ];

        $form['field_configuration']['field_labels_language']['error'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Error message for Language'),
            '#size' => 100,
            '#default_value' => $myAccountConfigValue['language_field']['options']['error'],
        ];

        $form['field_configuration']['field_labels_language']['weight'] = [
            '#type' => 'select',
            '#title' => $this->t('Field Weight'),
            '#disabled' => TRUE,
            '#options' => ['13' => '13'],
            '#default_value' => $myAccountConfigValue['language_field']['weight'],
        ];

        $form['field_configuration']['field_labels_language']['help_text'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Help text'),
            '#rows' => 5,
            '#description' => $this->t('Instructions to present to the user below this field on the editing form.'),
            '#default_value' => $myAccountConfigValue['language_field']['options']['help_text'],
        ];

        $form['field_configuration']['field_labels_language']['wrapper_class'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Language wrapper class'),
            '#size' => 25,
            '#description' => $this->t('Wrapper class for field.'),
            '#default_value' => $myAccountConfigValue['language_field']['options']['wrapper_class'],
        ];

        $form['field_configuration']['field_labels_language']['enable_tooltip'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Enable Tooltip'),
            '#required' => FALSE,
            '#default_value' => $myAccountConfigValue['language_field']['options']['attr']['enable_tooltip'],
        ];

        $form['field_configuration']['field_labels_language']['tooltip_blurb'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Tooltip Blurb'),
            '#required' => FALSE,
            '#default_value' => $myAccountConfigValue['language_field']['options']['attr']['tooltip_blurb'],
        ];

        $form['field_configuration']['field_labels_address'] = [
            '#type' => 'details',
            '#title' => 'Address',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_address']['label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Label'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the Address Field.'),
            '#default_value' => $myAccountConfigValue['address_field']['options']['label'],
        ];

        $form['field_configuration']['field_labels_address']['placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Placeholder'),
            '#size' => 25,
            '#description' => $this->t('Placeholder for the Address Field.'),
            '#default_value' => $myAccountConfigValue['address_field']['options']['attr']['placeholder'],
        ];

        $form['field_configuration']['field_labels_address']['weight'] = [
            '#type' => 'select',
            '#title' => $this->t('Field weight'),
            '#disabled' => TRUE,
            '#options' => ['14' => '14'],
            '#default_value' => '14',
        ];

        $form['field_configuration']['field_labels_address']['wrapper_class'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Address wrapper'),
            '#size' => 25,
            '#description' => $this->t('Wrapper class for field.'),
            '#default_value' => $myAccountConfigValue['address_field']['options']['wrapper_class'],
        ];

        $form['field_configuration']['field_labels_address']['enable_tooltip'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Enable Tooltip'),
            '#required' => FALSE,
            '#default_value' => $myAccountConfigValue['address_field']['options']['attr']['enable_tooltip'],
        ];

        $form['field_configuration']['field_labels_address']['tooltip_blurb'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Tooltip Blurb'),
            '#required' => FALSE,
            '#default_value' => $myAccountConfigValue['address_field']['options']['attr']['tooltip_blurb'],
        ];

        $form['field_configuration']['field_labels_city'] = [
            '#type' => 'details',
            '#title' => 'City',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_city']['label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Label'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the Address Field.'),
            '#default_value' => $myAccountConfigValue['city_field']['options']['label'],
        ];

        $form['field_configuration']['field_labels_city']['placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Placeholder'),
            '#size' => 25,
            '#description' => $this->t('Placeholder for the City Field.'),
            '#default_value' => $myAccountConfigValue['city_field']['options']['attr']['placeholder'],
        ];

        $form['field_configuration']['field_labels_city']['weight'] = [
            '#type' => 'select',
            '#title' => $this->t('Field weight'),
            '#disabled' => TRUE,
            '#options' => ['15' => '15'],
            '#default_value' => '15',
        ];

        $form['field_configuration']['field_labels_city']['wrapper_class'] = [
            '#type' => 'textfield',
            '#title' => $this->t('City wrapper'),
            '#size' => 25,
            '#description' => $this->t('Wrapper class for field.'),
            '#default_value' => $myAccountConfigValue['city_field']['options']['wrapper_class'],
        ];

        $form['field_configuration']['field_labels_city']['enable_tooltip'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Enable Tooltip'),
            '#required' => FALSE,
            '#default_value' => $myAccountConfigValue['city_field']['options']['attr']['enable_tooltip'],
        ];

        $form['field_configuration']['field_labels_city']['tooltip_blurb'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Tooltip Blurb'),
            '#required' => FALSE,
            '#default_value' => $myAccountConfigValue['city_field']['options']['attr']['tooltip_blurb'],
        ];

        $form['field_configuration']['field_labels_postal_code'] = [
            '#type' => 'details',
            '#title' => 'Postal Code',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_postal_code']['label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Label'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the Postal Code Field.'),
            '#default_value' => $myAccountConfigValue['postal_code_field']['options']['label'],
        ];

        $form['field_configuration']['field_labels_postal_code']['placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Placeholder'),
            '#size' => 25,
            '#description' => $this->t('Placeholder for the Postal Code Field.'),
            '#default_value' => $myAccountConfigValue['postal_code_field']['options']['attr']['placeholder'],
        ];

        $form['field_configuration']['field_labels_postal_code']['weight'] = [
            '#type' => 'select',
            '#title' => $this->t('Field weight'),
            '#disabled' => TRUE,
            '#options' => ['16' => '16'],
            '#default_value' => '16',
        ];

        $form['field_configuration']['field_labels_postal_code']['wrapper_class'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Postal Code wrapper'),
            '#size' => 25,
            '#description' => $this->t('Wrapper class for field.'),
            '#default_value' => $myAccountConfigValue['postal_code_field']['options']['wrapper_class'],
        ];

        $form['field_configuration']['field_labels_postal_code']['enable_tooltip'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Enable Tooltip'),
            '#required' => FALSE,
            '#default_value' => $myAccountConfigValue['postal_code_field']['options']['attr']['enable_tooltip'],
        ];

        $form['field_configuration']['field_labels_postal_code']['tooltip_blurb'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Tooltip Blurb'),
            '#required' => FALSE,
            '#default_value' => $myAccountConfigValue['postal_code_field']['options']['attr']['tooltip_blurb'],
        ];

        $form['field_configuration']['field_labels_contact_preference'] = [
            '#type' => 'details',
            '#title' => 'Contact Preference',
            '#open' => false,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_contact_preference']['label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Label'),
            '#size' => 25,
            '#required' => FALSE,
            '#description' => $this->t('Label for the Contact Preference Field.'),
            '#default_value' => $myAccountConfigValue['contact_preference_field']['options']['label'],
        ];

        $form['field_configuration']['field_labels_contact_preference']['weight'] = [
            '#type' => 'select',
            '#title' => $this->t('Field Weight'),
            '#disabled' => TRUE,
            '#options' => ['17' => '17'],
            '#default_value' => '17',
        ];

        $form['field_configuration']['field_labels_contact_preference']['wrapper_class'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Contact Preference wrapper class'),
            '#size' => 25,
            '#description' => $this->t('Wrapper class for field.'),
            '#default_value' => $myAccountConfigValue['contact_preference_field']['options']['wrapper_class'],
        ];

        $form['field_configuration']['field_labels_contact_preference']['enable_tooltip'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Enable Tooltip'),
            '#required' => FALSE,
            '#default_value' => $myAccountConfigValue['contact_preference_field']['options']['attr']['enable_tooltip'],
        ];

        $form['field_configuration']['field_labels_contact_preference']['tooltip_blurb'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Tooltip Blurb'),
            '#required' => FALSE,
            '#default_value' => $myAccountConfigValue['contact_preference_field']['options']['attr']['tooltip_blurb'],
        ];

        $form['field_configuration']['field_labels_account'] = [
            '#type' => 'details',
            '#title' => 'My Profile Header',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_account']['account_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Account Detail'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for Account Details'),
            '#default_value' => $myAccountConfigValue['account_field']['options']['label'],
        ];

        $form['field_configuration']['field_labels_account']['communication_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Communication Detail'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for Communication Details'),
            '#default_value' => $myAccountConfigValue['communication_detail_field']['options']['label'],
        ];

        $form['field_configuration']['field_labels_account']['home_address_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Home Address Details'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for Home Address'),
            '#default_value' => $myAccountConfigValue['home_address_field']['options']['label'],
        ];

        $form['field_configuration']['field_labels_account']['contact_preference'] = [
            '#type' => 'details',
            '#title' => 'Contact Prefrence',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_account']['contact_preference']['contact_preference_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Contact Preference'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for Contact Preference'),
            '#default_value' => $myAccountConfigValue['contact_preference_label']['options']['label'],
        ];

        $form['field_configuration']['field_labels_account']['contact_preference']['contact_preference_top_blurb'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Contact Preference Top Blurb'),
            '#required' => TRUE,
            '#description' => $this->t('Top Blurb of  Contact Preference'),
            '#default_value' => $myAccountConfigValue['contact_preference_top_blurb_field'],
        ];

        $form['field_configuration']['field_labels_account']['contact_preference']['contact_preference_bottom_blurb'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Contact Preference Bottom Blurb'),
            '#required' => TRUE,
            '#description' => $this->t('Bottom Blurb of  Contact Preference'),
            '#default_value' => $myAccountConfigValue['contact_preference_bottom_blurb_field'],
        ];

        $form['field_configuration']['field_labels_account']['contact_preference']['contact_preference_yes_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Contact Preference True Label'),
            '#required' => TRUE,
            '#default_value' => $myAccountConfigValue['contact_preference_yes_label_field'],
        ];

        $form['field_configuration']['field_labels_account']['contact_preference']['contact_preference_no_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Contact Preference False Label'),
            '#required' => TRUE,
            '#default_value' => $myAccountConfigValue['contact_preference_no_label_field'],
        ];

        $form['field_configuration']['field_labels_sms_verification'] = [
            '#type' => 'details',
            '#title' => 'SMS Verification',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_sms_verification']['enable_sms_verification'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Enable SMS Verification'),
            '#required' => FALSE,
            '#description' => $this->t('SMS Verification Feature Toggling'),
            '#default_value' => $myAccountConfigValue['enable_sms_verification_field'],
        ];

        $form['field_configuration']['field_labels_sms_verification']['verify_text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Verify Text'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Text for Verify Link'),
            '#default_value' => $myAccountConfigValue['verify_text_field'],
        ];

        $form['field_configuration']['field_labels_sms_verification']['modal_verify_header_text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Modal Verify Header Text'),
            '#required' => TRUE,
            '#description' => $this->t('Text modal verify text header'),
            '#default_value' => $myAccountConfigValue['modal_verify_header_text_field'],
        ];

        $form['field_configuration']['field_labels_sms_verification']['modal_verify_body_text'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Modal Verify Body Text'),
            '#required' => TRUE,
            '#description' => $this->t('Text modal verify body text'),
            '#default_value' => $myAccountConfigValue['modal_verify_body_text_field'],
        ];

        $form['field_configuration']['field_labels_sms_verification']['modal_verification_code_placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Modal Verification Code Placeholder'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Placeholder text for verification field textfield'),
            '#default_value' => $myAccountConfigValue['modal_verification_code_placeholder_field'],
        ];

        $form['field_configuration']['field_labels_sms_verification']['modal_verification_resend_code_text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Modal Resend Verification Code Text'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Text for resend verification code'),
            '#default_value' => $myAccountConfigValue['modal_verification_resend_code_text_field'],
        ];

        $form['field_configuration']['field_labels_sms_verification']['modal_verification_submit_text'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Modal Submit Verification Code Text'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Text for submit verification code'),
            '#default_value' => $myAccountConfigValue['modal_verification_submit_text_field'],
        ];

        $form['field_configuration']['field_labels_sms_verification']['verification_code_response'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Response from ICore'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Response from ICore'),
            '#default_value' => $myAccountConfigValue['verification_code_response_field'],
        ];

        $form['field_configuration']['field_labels_sms_verification']['verification_code_required_message'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Required Field Error Message'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Required Field Error Message'),
            '#default_value' => $myAccountConfigValue['verification_code_required_message_field'],
        ];

        $form['field_configuration']['field_labels_sms_verification']['verification_code_min_length_message'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Min Length Field Error Message'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Min Length Field Error Message'),
            '#default_value' => $myAccountConfigValue['verification_code_min_length_message_field'],
        ];

        $form['field_configuration']['field_labels_sms_verification']['verification_code_max_length_message'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Max Length Field Error Message'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Max Length Field Error Message'),
            '#default_value' => $myAccountConfigValue['verification_code_max_length_message_field'],
        ];

        $form['field_configuration']['field_labels_country_mapping'] = [
            '#type' => 'details',
            '#title' => 'Country Mapping',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_country_mapping']['country_mapping'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Country Mapping'),
            '#size' => 25,
            '#required' => TRUE,
            '#default_value' => $myAccountConfigValue['country_mapping_field'],
        ];

        $form['field_configuration']['field_labels_country_code_mapping'] = [
            '#type' => 'details',
            '#title' => 'Country Code Mapping',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_country_code_mapping']['country_code_mapping'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Country Code Mapping'),
            '#size' => 25,
            '#required' => TRUE,
            '#default_value' => $myAccountConfigValue['country_code_mapping_field'],
        ];

        $form['field_configuration']['field_labels_btn_config'] = [
            '#type' => 'details',
            '#title' => 'Button Config',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_btn_config']['save_changes'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Save Changes'),
            '#required' => TRUE,
            '#default_value' => $myAccountConfigValue['save_changes_field'],
        ];

        $form['field_configuration']['field_labels_btn_config']['cancel'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Cancel'),
            '#required' => TRUE,
            '#default_value' => $myAccountConfigValue['cancel_field'],
        ];

        $form['field_configuration']['field_labels_modal_preview'] = [
            '#type' => 'details',
            '#title' => 'Modal Preview',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_modal_preview']['modal_preview_header'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Modal Preview Header'),
            '#required' => TRUE,
            '#default_value' => $myAccountConfigValue['modal_preview_header_field'],
        ];

        $form['field_configuration']['field_labels_modal_preview']['modal_preview_top_blurb'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Modal Preview Top Blurb'),
            '#required' => TRUE,
            '#default_value' => $myAccountConfigValue['modal_preview_top_blurb_field'],
        ];

        $form['field_configuration']['field_labels_modal_preview']['modal_preview_current_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Modal Preview Current Label'),
            '#required' => TRUE,
            '#default_value' => $myAccountConfigValue['modal_preview_current_label_field'],
        ];

        $form['field_configuration']['field_labels_modal_preview']['modal_preview_new_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Modal Preview New Label'),
            '#required' => TRUE,
            '#default_value' => $myAccountConfigValue['modal_preview_new_label_field'],
        ];

        $form['field_configuration']['field_labels_modal_preview']['modal_preview_bottom_blurb'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Modal Preview Bottom Blurb'),
            '#required' => TRUE,
            '#default_value' => $myAccountConfigValue['modal_preview_bottom_blurb_field'],
        ];

        $form['field_configuration']['field_labels_modal_preview']['modal_preview_placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Modal Preview Password Placeholder'),
            '#required' => TRUE,
            '#default_value' => $myAccountConfigValue['modal_preview_placeholder_field'],
        ];

        $form['field_configuration']['field_labels_modal_preview']['modal_preview_btn'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Modal Preview Button'),
            '#required' => TRUE,
            '#default_value' => $myAccountConfigValue['modal_preview_btn_field'],
        ];

        $form['field_configuration']['field_labels_validation_configuration'] = [
            '#type' => 'details',
            '#title' => 'Validation Configuration',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_validation_configuration']['server_side_validation'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Server-side Validation Mapping'),
            '#required' => TRUE,
            '#default_value' => $myAccountConfigValue['server_side_validation_field'],
        ];

        $form['field_configuration']['field_labels_validation_configuration']['required_validation'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Required Error Message'),
            '#required' => TRUE,
            '#default_value' => $myAccountConfigValue['required_validation_field'],
        ];

        $form['field_configuration']['field_labels_validation_configuration']['mobile_number_validation'] = [
            '#type' => 'details',
            '#title' => 'Mobile Number',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_validation_configuration']['mobile_number_validation']['mobile_number_format_validation'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Mobile Number Format Error Message'),
            '#required' => TRUE,
            '#default_value' => $myAccountConfigValue['mobile_number_format_validation_field'],
        ];

        $form['field_configuration']['field_labels_validation_configuration']['mobile_number_validation']['mobile_number_min_length_validation'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Mobile Number Min Length Error Message'),
            '#required' => TRUE,
            '#default_value' => $myAccountConfigValue['mobile_number_min_length_validation_field'],
        ];

        $form['field_configuration']['field_labels_validation_configuration']['mobile_number_validation']['mobile_number_max_length_validation'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Mobile Number Max Length Error Message'),
            '#required' => TRUE,
            '#default_value' => $myAccountConfigValue['mobile_number_max_length_validation_field'],
        ];

        $form['field_configuration']['field_labels_validation_configuration']['address_validation'] = [
            '#type' => 'details',
            '#title' => 'Address',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_validation_configuration']['address_validation']['address_format_validation'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Address Format Error Message'),
            '#required' => TRUE,
            '#default_value' => $myAccountConfigValue['address_format_validation_field'],
        ];

        $form['field_configuration']['field_labels_validation_configuration']['address_validation']['address_min_length_validation'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Address Min Length Error Message'),
            '#required' => TRUE,
            '#default_value' => $myAccountConfigValue['address_min_length_validation_field'],
        ];

        $form['field_configuration']['field_labels_validation_configuration']['address_validation']['address_max_length_validation'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Address Max Length Error Message'),
            '#required' => TRUE,
            '#default_value' => $myAccountConfigValue['address_max_length_validation_field'],
        ];

        $form['field_configuration']['field_labels_validation_configuration']['city_validation'] = [
            '#type' => 'details',
            '#title' => 'City',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_validation_configuration']['city_validation']['city_format_validation'] = [
            '#type' => 'textfield',
            '#title' => $this->t('City Format Error Message'),
            '#required' => TRUE,
            '#default_value' => $myAccountConfigValue['city_format_validation_field'],
        ];

        $form['field_configuration']['field_labels_validation_configuration']['city_validation']['city_min_length_validation'] = [
            '#type' => 'textfield',
            '#title' => $this->t('City Min Length Error Message'),
            '#required' => TRUE,
            '#default_value' => $myAccountConfigValue['city_min_length_validation_field'],
        ];

        $form['field_configuration']['field_labels_validation_configuration']['city_validation']['city_max_length_validation'] = [
            '#type' => 'textfield',
            '#title' => $this->t('City Max Length Error Message'),
            '#required' => TRUE,
            '#default_value' => $myAccountConfigValue['city_max_length_validation_field'],
        ];

        $form['field_configuration']['field_labels_validation_configuration']['postal_code_validation'] = [
            '#type' => 'details',
            '#title' => 'Postal Code',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_validation_configuration']['postal_code_validation']['postal_code_format_validation'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Postal Code Format Error Message'),
            '#required' => TRUE,
            '#default_value' => $myAccountConfigValue['postal_code_format_validation_field'],
        ];

        $form['field_configuration']['field_labels_validation_configuration']['postal_code_validation']['postal_code_max_length_value'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Postal Code Max Length Value'),
            '#required' => TRUE,
            '#size' => 10,
            '#default_value' => $myAccountConfigValue['postal_code_max_length_value_field'],
        ];

        $form['field_configuration']['field_labels_validation_configuration']['postal_code_validation']['postal_code_max_length_validation'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Postal Code Max Length Error Message'),
            '#required' => TRUE,
            '#default_value' => $myAccountConfigValue['postal_code_max_length_validation_field'],
        ];

        $form['field_configuration']['field_labels_validation_configuration']['password_validation'] = [
            '#type' => 'details',
            '#title' => 'Password',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_validation_configuration']['password_validation']['password_format_validation'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Password Format Error Message'),
            '#required' => TRUE,
            '#default_value' => $myAccountConfigValue['password_format_validation_field'],
        ];

        $form['field_configuration']['field_labels_validation_configuration']['password_validation']['password_min_length_validation'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Password Min Length Error Message'),
            '#required' => TRUE,
            '#default_value' => $myAccountConfigValue['password_min_length_validation_field'],
        ];

        $form['field_configuration']['field_labels_validation_configuration']['password_validation']['password_max_length_validation'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Password Max Length Error Message'),
            '#required' => TRUE,
            '#default_value' => $myAccountConfigValue['password_max_length_validation_field'],
        ];

        $form['field_configuration']['field_labels_generic_configuration'] = [
            '#type' => 'details',
            '#title' => 'Generic Configuration',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_generic_configuration']['primary_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Label for primary mobile number tagging'),
            '#required' => TRUE,
            '#default_value' => $myAccountConfigValue['primary_label_field'],
        ];

        $form['field_configuration']['field_labels_generic_configuration']['add_mobile_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Label for adding mobile number link'),
            '#required' => TRUE,
            '#default_value' => $myAccountConfigValue['add_mobile_label_field'],
        ];

        $form['field_configuration']['field_labels_generic_configuration']['no_changed_detected_message'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Message if no changed has been detected'),
            '#required' => TRUE,
            '#default_value' => $myAccountConfigValue['no_changed_detected_message_field'],
        ];

        $form['field_configuration']['field_labels_generic_configuration']['male_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Label for Male'),
            '#required' => TRUE,
            '#default_value' => $myAccountConfigValue['male_label_field'],
        ];

        $form['field_configuration']['field_labels_generic_configuration']['female_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Label for Female'),
            '#required' => TRUE,
            '#default_value' => $myAccountConfigValue['female_label_field'],
        ];

        $form['actions'] = ['#type' => 'actions'];
        // Add a submit button that handles the submission of the form.
        $form['actions']['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Submit'),
        ];
        return $form;
    }

    /**
     * Getter method for Form ID.
     *
     * @inheritdoc
     */
    public function getFormId()
    {
        return 'fapi_change_password_config';
    }

    /**
     *
     * @inheritdoc
     */
    protected function getEditableConfigNames()
    {
        return ['my_account_form_profile.profile'];
    }


    /**
     * Implements a form submit handler.
     *
     * @param array $form
     *   The render array of the currently built form.
     * @param FormStateInterface $form_state
     *   Object describing the current state of the form.
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        $configuration = $form_state->getValue('field_configuration');
        $this->config('my_account_form_profile.profile')
            ->set('username_field.options.label', $configuration['field_labels_user_name']['label'])
            ->set('username_field.options.attr.placeholder', $configuration['field_labels_user_name']['placeholder'])
            ->set('username_field.options.attr.enable_tooltip', $configuration['field_labels_user_name']['enable_tooltip'])
            ->set('username_field.options.attr.tooltip_blurb', $configuration['field_labels_user_name']['tooltip_blurb'])
            ->set('currency_field.options.attr.enable_tooltip', $configuration['field_labels_currency']['enable_tooltip'])
            ->set('currency_field.options.attr.tooltip_blurb', $configuration['field_labels_currency']['tooltip_blurb'])
           ->set('first_name_field.options.attr.enable_tooltip', $configuration['field_labels_first_name']['enable_tooltip'])
            ->set('first_name_field.options.attr.tooltip_blurb', $configuration['field_labels_first_name']['tooltip_blurb'])
           ->set('last_name_field.options.attr.enable_tooltip', $configuration['field_labels_last_name']['enable_tooltip'])
            ->set('last_name_field.options.attr.tooltip_blurb', $configuration['field_labels_last_name']['tooltip_blurb'])
           ->set('dob_field.options.attr.enable_tooltip', $configuration['field_labels_dob']['enable_tooltip'])
            ->set('dob_field.options.attr.tooltip_blurb', $configuration['field_labels_dob']['tooltip_blurb'])
           ->set('country_field.options.attr.enable_tooltip', $configuration['field_labels_country']['enable_tooltip'])
            ->set('country_field.options.attr.tooltip_blurb', $configuration['field_labels_country']['tooltip_blurb'])
           ->set('email_field.options.attr.enable_tooltip', $configuration['field_labels_email']['enable_tooltip'])
            ->set('email_field.options.attr.tooltip_blurb', $configuration['field_labels_email']['tooltip_blurb'])
           ->set('gender_field.options.attr.enable_tooltip', $configuration['field_labels_gender']['enable_tooltip'])
            ->set('gender_field.options.attr.tooltip_blurb', $configuration['field_labels_gender']['tooltip_blurb'])
           ->set('mobile_number_field.options.attr.enable_tooltip', $configuration['field_labels_mobile_number']['enable_tooltip'])
            ->set('mobile_number_field.options.attr.tooltip_blurb', $configuration['field_labels_mobile_number']['tooltip_blurb'])
           ->set('language_field.options.attr.enable_tooltip', $configuration['field_labels_language']['enable_tooltip'])
            ->set('language_field.options.attr.tooltip_blurb', $configuration['field_labels_language']['tooltip_blurb'])
           ->set('address_field.options.attr.enable_tooltip', $configuration['field_labels_address']['enable_tooltip'])
            ->set('address_field.options.attr.tooltip_blurb', $configuration['field_labels_address']['tooltip_blurb'])
           ->set('city_field.options.attr.enable_tooltip', $configuration['field_labels_city']['enable_tooltip'])
            ->set('city_field.options.attr.tooltip_blurb', $configuration['field_labels_city']['tooltip_blurb'])
           ->set('postal_code_field.options.attr.enable_tooltip', $configuration['field_labels_postal_code']['enable_tooltip'])
            ->set('postal_code_field.options.attr.tooltip_blurb', $configuration['field_labels_postal_code']['tooltip_blurb'])
           ->set('contact_preference_field.options.attr.enable_tooltip', $configuration['field_labels_contact_preference']['enable_tooltip'])
            ->set('contact_preference_field.options.attr.tooltip_blurb', $configuration['field_labels_contact_preference']['tooltip_blurb'])
            ->set('username_field.weight', $configuration['field_labels_user_name']['weight'])
            ->set('dob_month.weight', $configuration['field_labels_dob']['field_labels_dob_month']['weight'])
            ->set('dob_month.options.wrapper_class', $configuration['field_labels_dob']['field_labels_dob_month']['wrapper_class'])
            ->set('dob_year.weight', $configuration['field_labels_dob']['field_labels_dob_year']['weight'])
            ->set('dob_year.options.wrapper_class', $configuration['field_labels_dob']['field_labels_dob_year']['wrapper_class'])
            ->set('dob_day.weight', $configuration['field_labels_dob']['field_labels_dob_day']['weight'])
            ->set('dob_day.options.wrapper_class', $configuration['field_labels_dob']['field_labels_dob_day']['wrapper_class'])
            ->set('username_field.options.wrapper_class', $configuration['field_labels_user_name']['wrapper_class'])
            ->set('currency_field.options.label', $configuration['field_labels_currency']['label'])
            ->set('currency_field.options.attr.placeholder', $configuration['field_labels_currency']['placeholder'])
            ->set('currency_field.options.error', $configuration['field_labels_currency']['error'])
            ->set('currency_field.weight', $configuration['field_labels_currency']['weight'])
            ->set('currency_field.options.wrapper_class', $configuration['field_labels_currency']['wrapper_class'])
            ->set('first_name_field.options.label', $configuration['field_labels_first_name']['label'])
            ->set('first_name_field.options.attr.placeholder', $configuration['field_labels_first_name']['placeholder'])
            ->set('first_name_field.options.error', $configuration['field_labels_first_name']['error'])
            ->set('first_name_field.weight', $configuration['field_labels_first_name']['weight'])
            ->set('first_name_field.options.wrapper_class', $configuration['field_labels_first_name']['wrapper_class'])
            ->set('last_name_field.options.label', $configuration['field_labels_last_name']['label'])
            ->set('last_name_field.options.attr.placeholder', $configuration['field_labels_last_name']['placeholder'])
            ->set('last_name_field.options.error', $configuration['field_labels_last_name']['error'])
            ->set('last_name_field.weight', $configuration['field_labels_last_name']['weight'])
            ->set('last_name_field.options.wrapper_class', $configuration['field_labels_last_name']['wrapper_class'])
            ->set('dob_field.options.label', $configuration['field_labels_dob']['label'])
            ->set('dob_field.options.error', $configuration['field_labels_dob']['error'])
            ->set('dob_field.weight', $configuration['field_labels_dob']['weight'])
            ->set('dob_field.options.wrapper_class', $configuration['field_labels_dob']['wrapper_class'])
            ->set('country_field.options.label', $configuration['field_labels_country']['label'])
            ->set('country_field.options.attr.placeholder', $configuration['field_labels_country']['placeholder'])
            ->set('country_field.options.error', $configuration['field_labels_country']['error'])
            ->set('country_field.weight', $configuration['field_labels_country']['weight'])
            ->set('country_field.options.wrapper_class', $configuration['field_labels_country']['wrapper_class'])
            ->set('email_field.options.label', $configuration['field_labels_email']['label'])
            ->set('email_field.options.attr.placeholder', $configuration['field_labels_email']['placeholder'])
            ->set('email_field.options.error', $configuration['field_labels_email']['error'])
            ->set('email_field.weight', $configuration['field_labels_email']['weight'])
            ->set('email_field.options.wrapper_class', $configuration['field_labels_email']['wrapper_class'])
            ->set('gender_field.options.label', $configuration['field_labels_gender']['label'])
            ->set('gender_field.weight', $configuration['field_labels_gender']['weight'])
            ->set('gender_field.options.wrapper_class', $configuration['field_labels_gender']['wrapper_class'])
            ->set('mobile_number_field.options.label', $configuration['field_labels_mobile_number']['label'])
            ->set('mobile_number_field.options.attr.placeholder', $configuration['field_labels_mobile_number']['placeholder'])
            ->set('mobile_number_field.weight', $configuration['field_labels_mobile_number']['weight'])
            ->set('mobile_number_field.options.wrapper_class', $configuration['field_labels_mobile_number']['wrapper_class'])
            ->set('mobile_number_1_field.options.label', $configuration['field_labels_mobile_number_1']['label'])
            ->set('mobile_number_1_field.options.attr.placeholder', $configuration['field_labels_mobile_number_1']['placeholder'])
            ->set('mobile_number_1_field.weight', $configuration['field_labels_mobile_number_1']['weight'])
            ->set('mobile_number_1_field.options.wrapper_class', $configuration['field_labels_mobile_number_1']['wrapper_class'])
            ->set('language_field.options.label', $configuration['field_labels_language']['label'])
            ->set('language_field.options.attr.placeholder', $configuration['field_labels_language']['placeholder'])
            ->set('language_field.options.error', $configuration['field_labels_language']['error'])
            ->set('language_field.weight', $configuration['field_labels_language']['weight'])
            ->set('language_field.options.help_text', $configuration['field_labels_language']['help_text'])
            ->set('language_field.options.wrapper_class', $configuration['field_labels_language']['wrapper_class'])
            ->set('address_field.options.label', $configuration['field_labels_address']['label'])
            ->set('address_field.options.attr.placeholder', $configuration['field_labels_address']['placeholder'])
            ->set('address_field.weight', $configuration['field_labels_address']['weight'])
            ->set('address_field.options.wrapper_class', $configuration['field_labels_address']['wrapper_class'])
            ->set('city_field.options.label', $configuration['field_labels_city']['label'])
            ->set('city_field.options.attr.placeholder', $configuration['field_labels_city']['placeholder'])
            ->set('city_field.weight', $configuration['field_labels_city']['weight'])
            ->set('city_field.options.wrapper_class', $configuration['field_labels_city']['wrapper_class'])
            ->set('postal_code_field.options.label', $configuration['field_labels_postal_code']['label'])
            ->set('postal_code_field.options.attr.placeholder', $configuration['field_labels_postal_code']['placeholder'])
            ->set('postal_code_field.weight', $configuration['field_labels_postal_code']['weight'])
            ->set('postal_code_field.options.wrapper_class', $configuration['field_labels_postal_code']['wrapper_class'])
            ->set('contact_preference_field.options.label', $configuration['field_labels_contact_preference']['label'])
            ->set('contact_preference_field.weight', $configuration['field_labels_contact_preference']['weight'])
            ->set('contact_preference_field.options.wrapper_class', $configuration['field_labels_contact_preference']['wrapper_class'])
            ->set('account_field.options.label', $configuration['field_labels_account']['account_label'])
            ->set('communication_detail_field.options.label', $configuration['field_labels_account']['communication_label'])
            ->set('home_address_field.options.label', $configuration['field_labels_account']['home_address_label'])
            ->set('contact_preference_label.options.label', $configuration['field_labels_account']['contact_preference']['contact_preference_label'])
            ->set('contact_preference_top_blurb_field', $configuration['field_labels_account']['contact_preference']['contact_preference_top_blurb'])
            ->set('contact_preference_bottom_blurb_field', $configuration['field_labels_account']['contact_preference']['contact_preference_bottom_blurb'])
            ->set('contact_preference_yes_label_field', $configuration['field_labels_account']['contact_preference']['contact_preference_yes_label'])
            ->set('contact_preference_no_label_field', $configuration['field_labels_account']['contact_preference']['contact_preference_no_label'])
            ->set('enable_sms_verification_field', $configuration['field_labels_sms_verification']['enable_sms_verification'])
            ->set('verify_text_field', $configuration['field_labels_sms_verification']['verify_text'])
            ->set('modal_verify_header_text_field', $configuration['field_labels_sms_verification']['modal_verify_header_text'])
            ->set('modal_verify_body_text_field', $configuration['field_labels_sms_verification']['modal_verify_body_text'])
            ->set('modal_verification_code_placeholder_field', $configuration['field_labels_sms_verification']['modal_verification_code_placeholder'])
            ->set('modal_verification_resend_code_text_field', $configuration['field_labels_sms_verification']['modal_verification_resend_code_text'])
            ->set('modal_verification_submit_text_field', $configuration['field_labels_sms_verification']['modal_verification_submit_text'])
            ->set('verification_code_response_field', $configuration['field_labels_sms_verification']['verification_code_response'])
            ->set('verification_code_required_message_field', $configuration['field_labels_sms_verification']['verification_code_required_message'])
            ->set('verification_code_min_length_message_field', $configuration['field_labels_sms_verification']['verification_code_min_length_message'])
            ->set('verification_code_max_length_message_field', $configuration['field_labels_sms_verification']['verification_code_max_length_message'])
            ->set('country_mapping_field', $configuration['field_labels_country_mapping']['country_mapping'])
            ->set('country_code_mapping_field', $configuration['field_labels_country_code_mapping']['country_code_mapping'])
            ->set('save_changes_field', $configuration['field_labels_btn_config']['save_changes'])
            ->set('cancel_field', $configuration['field_labels_btn_config']['cancel'])
            ->set('modal_preview_header_field', $configuration['field_labels_modal_preview']['modal_preview_header'])
            ->set('modal_preview_top_blurb_field', $configuration['field_labels_modal_preview']['modal_preview_top_blurb'])
            ->set('modal_preview_current_label_field', $configuration['field_labels_modal_preview']['modal_preview_current_label'])
            ->set('modal_preview_new_label_field', $configuration['field_labels_modal_preview']['modal_preview_new_label'])
            ->set('modal_preview_bottom_blurb_field', $configuration['field_labels_modal_preview']['modal_preview_bottom_blurb'])
            ->set('modal_preview_placeholder_field', $configuration['field_labels_modal_preview']['modal_preview_placeholder'])
            ->set('modal_preview_btn_field', $configuration['field_labels_modal_preview']['modal_preview_btn'])
            ->set('server_side_validation_field', $configuration['field_labels_validation_configuration']['server_side_validation'])
            ->set('required_validation_field', $configuration['field_labels_validation_configuration']['required_validation'])
            ->set('mobile_number_format_validation_field', $configuration['field_labels_validation_configuration']['mobile_number_validation']['mobile_number_format_validation'])
            ->set('mobile_number_min_length_validation_field', $configuration['field_labels_validation_configuration']['mobile_number_validation']['mobile_number_min_length_validation'])
            ->set('mobile_number_max_length_validation_field', $configuration['field_labels_validation_configuration']['mobile_number_validation']['mobile_number_max_length_validation'])
            ->set('address_max_length_validation_field', $configuration['field_labels_validation_configuration']['address_validation']['address_max_length_validation'])
            ->set('address_min_length_validation_field', $configuration['field_labels_validation_configuration']['address_validation']['address_min_length_validation'])
            ->set('address_format_validation_field', $configuration['field_labels_validation_configuration']['address_validation']['address_format_validation'])
            ->set('city_max_length_validation_field', $configuration['field_labels_validation_configuration']['city_validation']['city_max_length_validation'])
            ->set('city_min_length_validation_field', $configuration['field_labels_validation_configuration']['city_validation']['city_min_length_validation'])
            ->set('city_format_validation_field', $configuration['field_labels_validation_configuration']['city_validation']['city_format_validation'])
            ->set('postal_code_max_length_validation_field', $configuration['field_labels_validation_configuration']['postal_code_validation']['postal_code_max_length_validation'])
            ->set('postal_code_max_length_value_field', $configuration['field_labels_validation_configuration']['postal_code_validation']['postal_code_max_length_value'])
            ->set('postal_code_format_validation_field', $configuration['field_labels_validation_configuration']['postal_code_validation']['postal_code_format_validation'])
            ->set('password_max_length_validation_field', $configuration['field_labels_validation_configuration']['password_validation']['password_max_length_validation'])
            ->set('password_min_length_validation_field', $configuration['field_labels_validation_configuration']['password_validation']['password_min_length_validation'])
            ->set('password_format_validation_field', $configuration['field_labels_validation_configuration']['password_validation']['password_format_validation'])
            ->set('primary_label_field', $configuration['field_labels_generic_configuration']['primary_label'])
            ->set('add_mobile_label_field', $configuration['field_labels_generic_configuration']['add_mobile_label'])
            ->set('no_changed_detected_message_field', $configuration['field_labels_generic_configuration']['no_changed_detected_message'])
            ->set('male_label_field', $configuration['field_labels_generic_configuration']['male_label'])
            ->set('female_label_field', $configuration['field_labels_generic_configuration']['female_label'])
            ->save();
    }

    /**
     * The path alias manager.
     *
     * @var \Drupal\Core\Path\AliasManagerInterface
     */
    protected $aliasManager;

    /**
     * The path validator.
     *
     * @var \Drupal\Core\Path\PathValidatorInterface
     */
    protected $pathValidator;

    /**
     * The request context.
     *
     * @var \Drupal\Core\Routing\RequestContext
     */
    protected $requestContext;

    /**
     * Constructs a SiteInformationForm object.
     *
     * @param \Drupal\Core\Config\ConfigFactoryInterface $config_factory
     *   The factory for configuration objects.
     * @param \Drupal\Core\Path\AliasManagerInterface $alias_manager
     *   The path alias manager.
     * @param \Drupal\Core\Path\PathValidatorInterface $path_validator
     *   The path validator.
     * @param \Drupal\Core\Routing\RequestContext $request_context
     *   The request context.
     */
    public function __construct(ConfigFactoryInterface $config_factory, AliasManagerInterface $alias_manager, PathValidatorInterface $path_validator, RequestContext $request_context)
    {
        parent::__construct($config_factory);

        $this->aliasManager = $alias_manager;
        $this->pathValidator = $path_validator;
        $this->requestContext = $request_context;
    }

    /**
     * {@inheritdoc}
     */
    public static function create(ContainerInterface $container)
    {
        return new static(
            $container->get('config.factory'),
            $container->get('path.alias_manager'),
            $container->get('path.validator'),
            $container->get('router.request_context')
        );
    }

}
