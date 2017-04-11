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

        $form['field_configuration']['field_labels_user_name']['required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Required field'),
            '#default_value' => $myAccountConfigValue['username_field']['options']['required'],
        ];

        $form['field_configuration']['field_labels_user_name']['default_detail'] = [
            '#type' => 'details',
            '#title' => 'Tooltip Detail',
            '#description' => $this->t('Tooltip configuration'),
        ];

        $form['field_configuration']['field_labels_user_name']['default_detail']['tooltip_message'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Tooltip Message'),
            '#size' => 225,
            '#description' => $this->t('Tooltip detail for field.'),
            '#default_value' => $myAccountConfigValue['username_field']['options']['tooltip_message'],
        ];

        $form['field_configuration']['field_labels_user_name']['default_detail']['tooltip_required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Tooltip required'),
            '#default_value' => $myAccountConfigValue['username_field']['options']['tooltip_required'],
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

        $form['field_configuration']['field_labels_currency']['required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Required field'),
            '#default_value' => $myAccountConfigValue['currency_field']['options']['required'],
        ];

        $form['field_configuration']['field_labels_currency']['default_detail'] = [
            '#type' => 'details',
            '#title' => 'Tooltip Detail',
            '#description' => $this->t('Tooltip configuration'),
        ];

        $form['field_configuration']['field_labels_currency']['default_detail']['tooltip_message'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Tooltip Message'),
            '#size' => 225,
            '#description' => $this->t('Tooltip detail for field.'),
            '#default_value' => $myAccountConfigValue['username_field']['options']['tooltip_message'],
        ];

        $form['field_configuration']['field_labels_currency']['default_detail']['tooltip_required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Tooltip required'),
            '#default_value' => $myAccountConfigValue['username_field']['options']['tooltip_required'],
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

        $form['field_configuration']['field_labels_gender']['choices'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Choices'),
            '#description' => $this->t('Choices for key|value'),
            '#maxlength' => 255,
            '#default_value' => $myAccountConfigValue['gender_field']['options']['choices']
        ];
        $form['field_configuration']['field_labels_gender']['required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Required field'),
            '#default_value' => $myAccountConfigValue['gender_field']['options']['required'],
        ];

        $form['field_configuration']['field_labels_gender']['default_detail'] = [
            '#type' => 'details',
            '#title' => 'Tooltip Detail',
            '#description' => $this->t('Tooltip configuration'),
        ];

        $form['field_configuration']['field_labels_gender']['default_detail']['tooltip_message'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Tooltip Message'),
            '#size' => 225,
            '#description' => $this->t('Tooltip detail for field.'),
            '#default_value' => $myAccountConfigValue['gender_field']['options']['tooltip_message'],
        ];

        $form['field_configuration']['field_labels_gender']['default_detail']['tooltip_required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Tooltip required'),
            '#default_value' => $myAccountConfigValue['gender_field']['options']['tooltip_required'],
        ];

        $form['field_configuration']['field_labels_gender']['weight'] = [
            '#type' => 'select',
            '#title' => $this->t('Field weight'),
            '#disabled' => TRUE,
            '#options' => ['0' => '0'],
            '#default_value' => $myAccountConfigValue['gender_field']['weight'],
        ];

        $form['field_configuration']['field_labels_gender']['wrapper_class'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Gender wrapper'),
            '#size' => 25,
            '#description' => $this->t('Wrapper class for field.'),
            '#default_value' => $myAccountConfigValue['gender_field']['options']['wrapper_class'],
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

        $form['field_configuration']['field_labels_first_name']['required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Required field'),
            '#default_value' => $myAccountConfigValue['first_name_field']['options']['required'],
        ];
        $form['field_configuration']['field_labels_first_name']['default_detail'] = [
            '#type' => 'details',
            '#title' => 'Tooltip Detail',
            '#description' => $this->t('Tooltip configuration'),
        ];

        $form['field_configuration']['field_labels_first_name']['default_detail']['tooltip_message'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Tooltip Message'),
            '#size' => 225,
            '#description' => $this->t('Tooltip detail for field.'),
            '#default_value' => $myAccountConfigValue['username_field']['options']['tooltip_message'],
        ];

        $form['field_configuration']['field_labels_first_name']['default_detail']['tooltip_required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Tooltip required'),
            '#default_value' => $myAccountConfigValue['username_field']['options']['tooltip_required'],
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

        $form['field_configuration']['field_labels_last_name']['required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Required field'),
            '#default_value' => $myAccountConfigValue['last_name_field']['options']['required'],
        ];
        $form['field_configuration']['field_labels_last_name']['default_detail'] = [
            '#type' => 'details',
            '#title' => 'Tooltip Detail',
            '#description' => $this->t('Tooltip configuration'),
        ];

        $form['field_configuration']['field_labels_last_name']['default_detail']['tooltip_message'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Tooltip Message'),
            '#size' => 225,
            '#description' => $this->t('Tooltip detail for field.'),
            '#default_value' => $myAccountConfigValue['username_field']['options']['tooltip_message'],
        ];

        $form['field_configuration']['field_labels_last_name']['default_detail']['tooltip_required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Tooltip required'),
            '#default_value' => $myAccountConfigValue['username_field']['options']['tooltip_required'],
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

        $form['field_configuration']['field_labels_dob']['required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Required field'),
            '#default_value' => $myAccountConfigValue['dob_field']['options']['required'],
        ];
        $form['field_configuration']['field_labels_dob']['default_detail'] = [
            '#type' => 'details',
            '#title' => 'Tooltip Detail',
            '#description' => $this->t('Tooltip configuration'),
        ];

        $form['field_configuration']['field_labels_dob']['default_detail']['tooltip_message'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Tooltip Message'),
            '#size' => 225,
            '#description' => $this->t('Tooltip detail for field.'),
            '#default_value' => $myAccountConfigValue['username_field']['options']['tooltip_message'],
        ];

        $form['field_configuration']['field_labels_dob']['default_detail']['tooltip_required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Tooltip required'),
            '#default_value' => $myAccountConfigValue['username_field']['options']['tooltip_required'],
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

        $form['field_configuration']['field_labels_country']['choices'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Choices'),
            '#description' => $this->t('Choices for key|value'),
            '#maxlength' => 255,
            '#default_value' => $myAccountConfigValue['country_field']['options']['choices']
        ];

        $form['field_configuration']['field_labels_country']['required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Required field'),
            '#default_value' => $myAccountConfigValue['country_field']['options']['required'],
        ];
        $form['field_configuration']['field_labels_country']['default_detail'] = [
            '#type' => 'details',
            '#title' => 'Tooltip Detail',
            '#description' => $this->t('Tooltip configuration'),
        ];

        $form['field_configuration']['field_labels_country']['default_detail']['tooltip_message'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Tooltip Message'),
            '#size' => 225,
            '#description' => $this->t('Tooltip detail for field.'),
            '#default_value' => $myAccountConfigValue['username_field']['options']['tooltip_message'],
        ];

        $form['field_configuration']['field_labels_country']['default_detail']['tooltip_required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Tooltip required'),
            '#default_value' => $myAccountConfigValue['username_field']['options']['tooltip_required'],
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
            '#options' => ['8' => '8'],
            '#default_value' => $myAccountConfigValue['country_field']['weight'],
        ];

        $form['field_configuration']['field_labels_country']['wrapper_class'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Country wrapper class'),
            '#size' => 25,
            '#description' => $this->t('Wrapper class for field.'),
            '#default_value' => $myAccountConfigValue['country_field']['options']['wrapper_class'],
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

        $form['field_configuration']['field_labels_email']['required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Required field'),
            '#default_value' => $myAccountConfigValue['email_field']['options']['required'],
        ];
        $form['field_configuration']['field_labels_email']['default_detail'] = [
            '#type' => 'details',
            '#title' => 'Tooltip Detail',
            '#description' => $this->t('Tooltip configuration'),
        ];

        $form['field_configuration']['field_labels_email']['default_detail']['tooltip_message'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Tooltip Message'),
            '#size' => 225,
            '#description' => $this->t('Tooltip detail for field.'),
            '#default_value' => $myAccountConfigValue['username_field']['options']['tooltip_message'],
        ];

        $form['field_configuration']['field_labels_email']['default_detail']['tooltip_required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Tooltip required'),
            '#default_value' => $myAccountConfigValue['username_field']['options']['tooltip_required'],
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
            '#options' => ['9' => '9'],
            '#default_value' => $myAccountConfigValue['email_field']['weight'],
        ];

        $form['field_configuration']['field_labels_email']['wrapper_class'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Email wrapper class'),
            '#size' => 25,
            '#description' => $this->t('Wrapper class for field.'),
            '#default_value' => $myAccountConfigValue['email_field']['options']['wrapper_class'],
        ];

        $form['field_configuration']['field_labels_mobile_number'] = [
            '#type' => 'details',
            '#title' => 'Mobile Number',
            '#open' => False,
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

        $form['field_configuration']['field_labels_mobile_number']['required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Required field'),
            '#default_value' => $myAccountConfigValue['mobile_number_field']['options']['required'],
        ];
        $form['field_configuration']['field_labels_mobile_number']['default_detail'] = [
            '#type' => 'details',
            '#title' => 'Tooltip Detail',
            '#description' => $this->t('Tooltip configuration'),
        ];

        $form['field_configuration']['field_labels_mobile_number']['default_detail']['tooltip_message'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Tooltip Message'),
            '#size' => 225,
            '#description' => $this->t('Tooltip detail for field.'),
            '#default_value' => $myAccountConfigValue['username_field']['options']['tooltip_message'],
        ];

        $form['field_configuration']['field_labels_mobile_number']['default_detail']['tooltip_required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Tooltip required'),
            '#default_value' => $myAccountConfigValue['username_field']['options']['tooltip_required'],
        ];
        $form['field_configuration']['field_labels_mobile_number']['error'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Error message for Mobile number'),
            '#size' => 100,
            '#default_value' => $myAccountConfigValue['mobile_number_field']['options']['error'],
        ];

        $form['field_configuration']['field_labels_mobile_number']['weight'] = [
            '#type' => 'select',
            '#title' => $this->t('Field Weight'),
            '#disabled' => TRUE,
            '#options' => ['10' => '10'],
            '#default_value' => $myAccountConfigValue['mobile_number_field']['weight'],
        ];

        $form['field_configuration']['field_labels_mobile_number']['wrapper_class'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Mobile no. wrapper class'),
            '#size' => 25,
            '#description' => $this->t('Wrapper class for field.'),
            '#default_value' => $myAccountConfigValue['mobile_number_field']['options']['wrapper_class'],
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

        $form['field_configuration']['field_labels_language']['required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Required field'),
            '#default_value' => $myAccountConfigValue['language_field']['options']['required'],
        ];
        $form['field_configuration']['field_labels_language']['default_detail'] = [
            '#type' => 'details',
            '#title' => 'Tooltip Detail',
            '#description' => $this->t('Tooltip configuration'),
        ];

        $form['field_configuration']['field_labels_language']['default_detail']['tooltip_message'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Tooltip Message'),
            '#size' => 225,
            '#description' => $this->t('Tooltip detail for field.'),
            '#default_value' => $myAccountConfigValue['username_field']['options']['tooltip_message'],
        ];

        $form['field_configuration']['field_labels_language']['default_detail']['tooltip_required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Tooltip required'),
            '#default_value' => $myAccountConfigValue['username_field']['options']['tooltip_required'],
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
            '#options' => ['11' => '11'],
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
            '#description' => $this->t('Label for the language Field.'),
            '#default_value' => $myAccountConfigValue['account_field']['options']['label'],
        ];

        $form['field_configuration']['field_labels_account']['communication_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Communication Detail'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the language Field.'),
            '#default_value' => $myAccountConfigValue['communication_detail_field']['options']['label'],
        ];
        $form['field_configuration']['field_submit_button_labels'] = [
            '#type' => 'details',
            '#title' => 'Submit Button Label',
            '#group' => 'submit_button',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_submit_button_labels']['submit_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Submit Button'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the Submit button.'),
            '#default_value' => $myAccountConfigValue['submit_button_label_field']['options']['label']
        ];

        $form['field_configuration']['field_submit_button_labels']['cancel_label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Cancel Button'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the Cancel button.'),
            '#default_value' => $myAccountConfigValue['cancel_button_label_field']['options']['label']
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
            ->set('username_field.options.tooltip_message', $configuration['field_labels_user_name']['default_detail']['tooltip_message'])
            ->set('username_field.options.tooltip_required', $configuration['field_labels_user_name']['default_detail']['tooltip_required'])
            ->set('username_field.options.attr.placeholder', $configuration['field_labels_user_name']['placeholder'])
            ->set('username_field.options.required', $configuration['field_labels_user_name']['required'])
            ->set('username_field.weight', $configuration['field_labels_user_name']['weight'])
            ->set('gender_field.options.label', $configuration['field_labels_gender']['label'])
            ->set('gender_field.options.choices', $configuration['field_labels_gender']['choices'])
            ->set('gender_field.options.tooltip_message', $configuration['field_labels_gender']['default_detail']['tooltip_message'])
            ->set('gender_field.options.tooltip_required', $configuration['field_labels_gender']['default_detail']['tooltip_required'])
            ->set('gender_field.options.required', $configuration['field_labels_gender']['required'])
            ->set('gender_field.weight', $configuration['field_labels_gender']['weight'])
            ->set('dob_month.weight', $configuration['field_labels_dob']['field_labels_dob_month']['weight'])
            ->set('dob_month.options.wrapper_class', $configuration['field_labels_dob']['field_labels_dob_month']['wrapper_class'])
            ->set('dob_year.weight', $configuration['field_labels_dob']['field_labels_dob_year']['weight'])
            ->set('dob_year.options.wrapper_class', $configuration['field_labels_dob']['field_labels_dob_year']['wrapper_class'])
            ->set('dob_day.weight', $configuration['field_labels_dob']['field_labels_dob_day']['weight'])
            ->set('dob_day.options.wrapper_class', $configuration['field_labels_dob']['field_labels_dob_day']['wrapper_class'])
            ->set('username_field.options.wrapper_class', $configuration['field_labels_user_name']['wrapper_class'])
            ->set('currency_field.options.label', $configuration['field_labels_currency']['label'])
            ->set('currency_field.options.tooltip_message', $configuration['field_labels_currency']['default_detail']['tooltip_message'])
            ->set('currency_field.options.tooltip_required', $configuration['field_labels_currency']['default_detail']['tooltip_required'])
            ->set('currency_field.options.attr.placeholder', $configuration['field_labels_currency']['placeholder'])
            ->set('currency_field.options.required', $configuration['field_labels_currency']['required'])
            ->set('currency_field.options.error', $configuration['field_labels_currency']['error'])
            ->set('currency_field.weight', $configuration['field_labels_currency']['weight'])
            ->set('currency_field.options.wrapper_class', $configuration['field_labels_currency']['wrapper_class'])
            ->set('first_name_field.options.label', $configuration['field_labels_first_name']['label'])
            ->set('first_name_field.options.tooltip_message', $configuration['field_labels_first_name']['default_detail']['tooltip_message'])
            ->set('first_name_field.options.tooltip_required', $configuration['field_labels_first_name']['default_detail']['tooltip_required'])
            ->set('first_name_field.options.attr.placeholder', $configuration['field_labels_first_name']['placeholder'])
            ->set('first_name_field.options.required', $configuration['field_labels_first_name']['required'])
            ->set('first_name_field.options.error', $configuration['field_labels_first_name']['error'])
            ->set('first_name_field.weight', $configuration['field_labels_first_name']['weight'])
            ->set('first_name_field.options.wrapper_class', $configuration['field_labels_first_name']['wrapper_class'])
            ->set('last_name_field.options.label', $configuration['field_labels_last_name']['label'])
            ->set('last_name_field.options.tooltip_message', $configuration['field_labels_last_name']['default_detail']['tooltip_message'])
            ->set('last_name_field.options.tooltip_required', $configuration['field_labels_last_name']['default_detail']['tooltip_required'])
            ->set('last_name_field.options.attr.placeholder', $configuration['field_labels_last_name']['placeholder'])
            ->set('last_name_field.options.required', $configuration['field_labels_last_name']['required'])
            ->set('last_name_field.options.error', $configuration['field_labels_last_name']['error'])
            ->set('last_name_field.weight', $configuration['field_labels_last_name']['weight'])
            ->set('last_name_field.options.wrapper_class', $configuration['field_labels_last_name']['wrapper_class'])
            ->set('dob_field.options.label', $configuration['field_labels_dob']['label'])
            ->set('dob_field.options.tooltip_message', $configuration['field_labels_dob']['default_detail']['tooltip_message'])
            ->set('dob_field.options.tooltip_required', $configuration['field_labels_dob']['default_detail']['tooltip_required'])
            ->set('dob_field.options.required', $configuration['field_labels_dob']['required'])
            ->set('dob_field.options.error', $configuration['field_labels_dob']['error'])
            ->set('dob_field.weight', $configuration['field_labels_dob']['weight'])
            ->set('dob_field.options.wrapper_class', $configuration['field_labels_dob']['wrapper_class'])
            ->set('country_field.options.label', $configuration['field_labels_country']['label'])
            ->set('country_field.options.tooltip_message', $configuration['field_labels_country']['default_detail']['tooltip_message'])
            ->set('country_field.options.tooltip_required', $configuration['field_labels_country']['default_detail']['tooltip_required'])
            ->set('country_field.options.choices', $configuration['field_labels_country']['choices'])
            ->set('country_field.options.required', $configuration['field_labels_country']['required'])
            ->set('country_field.options.error', $configuration['field_labels_country']['error'])
            ->set('country_field.weight', $configuration['field_labels_country']['weight'])
            ->set('country_field.options.wrapper_class', $configuration['field_labels_country']['wrapper_class'])
            ->set('email_field.options.label', $configuration['field_labels_email']['label'])
            ->set('email_field.options.tooltip_message', $configuration['field_labels_email']['default_detail']['tooltip_message'])
            ->set('email_field.options.tooltip_required', $configuration['field_labels_email']['default_detail']['tooltip_required'])
            ->set('email_field.options.attr.placeholder', $configuration['field_labels_email']['placeholder'])
            ->set('email_field.options.required', $configuration['field_labels_email']['required'])
            ->set('email_field.options.error', $configuration['field_labels_email']['error'])
            ->set('email_field.weight', $configuration['field_labels_email']['weight'])
            ->set('email_field.options.wrapper_class', $configuration['field_labels_email']['wrapper_class'])
            ->set('mobile_number_field.label', $configuration['field_labels_mobile_number']['label'])
            ->set('mobile_number_field.options.tooltip_message', $configuration['field_labels_mobile_number']['default_detail']['tooltip_message'])
            ->set('mobile_number_field.options.tooltip_required', $configuration['field_labels_mobile_number']['default_detail']['tooltip_required'])
            ->set('mobile_number_field.placeholder', $configuration['field_labels_mobile_number']['placeholder'])
            ->set('mobile_number_field.options.required', $configuration['field_labels_mobile_number']['required'])
            ->set('mobile_number_field.options.error', $configuration['field_labels_mobile_number']['error'])
            ->set('mobile_number_field.weight', $configuration['field_labels_mobile_number']['weight'])
            ->set('mobile_number_field.options.wrapper_class', $configuration['field_labels_mobile_number']['wrapper_class'])
            ->set('language_field.options.label', $configuration['field_labels_language']['label'])
            ->set('language_field.options.tooltip_message', $configuration['field_labels_language']['default_detail']['tooltip_message'])
            ->set('language_field.options.tooltip_required', $configuration['field_labels_language']['default_detail']['tooltip_required'])
            ->set('language_field.options.attr.placeholder', $configuration['field_labels_language']['placeholder'])
            ->set('language_field.options.required', $configuration['field_labels_language']['required'])
            ->set('language_field.options.error', $configuration['field_labels_language']['error'])
            ->set('language_field.weight', $configuration['field_labels_language']['weight'])
            ->set('language_field.options.help_text', $configuration['field_labels_language']['help_text'])
            ->set('language_field.options.wrapper_class', $configuration['field_labels_language']['wrapper_class'])
            ->set('account_field.options.label', $configuration['field_labels_account']['account_label'])
            ->set('communication_detail_field.options.label', $configuration['field_labels_account']['communication_label'])
            ->set('submit_button_label_field.options.label', $configuration['field_submit_button_labels']['submit_label'])
            ->set('cancel_button_label_field.options.label', $configuration['field_submit_button_labels']['cancel_label'])
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
