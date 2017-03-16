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
            '#title' => t('Label'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the username Field.'),
            '#default_value' => $myAccountConfigValue['username_field']['label']
        ];

        $form['field_configuration']['field_labels_user_name']['required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Required field'),
            '#default_value' => $myAccountConfigValue['username_field']['required']
        ];

        $form['field_configuration']['field_labels_user_name']['weight'] = [
            '#type' => 'select',
            '#title' => $this->t('Field weight'),
            '#options' => array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'),
            '#default_value' => $myAccountConfigValue['username_field']['weight']
        ];

        $form['field_configuration']['field_labels_user_name']['wrapper'] = [
            '#type' => 'textfield',
            '#title' => t('Username wrapper'),
            '#size' => 25,
            '#description' => $this->t('Wrapper class for field.'),
            '#default_value' => $myAccountConfigValue['username_field']['wrapper']
        ];

        $form['field_configuration']['field_labels_currency'] = [
            '#type' => 'details',
            '#title' => 'Currency',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_currency']['label'] = [
            '#type' => 'textfield',
            '#title' => t('Label'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the currency Field.'),
            '#default_value' => $myAccountConfigValue['currency_field']['label']
        ];

        $form['field_configuration']['field_labels_currency']['required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Required field'),
            '#default_value' => $myAccountConfigValue['currency_field']['required']
        ];

        $form['field_configuration']['field_labels_currency']['error'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Error message for currency'),
            '#size' => 100,
            '#default_value' => $myAccountConfigValue['currency_field']['error']
        ];

        $form['field_configuration']['field_labels_currency']['weight'] = [
            '#type' => 'select',
            '#title' => $this->t('Field Weight'),
            '#options' => array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'),
            '#default_value' => $myAccountConfigValue['currency_field']['weight']
        ];

        $form['field_configuration']['field_labels_currency']['wrapper'] = [
            '#type' => 'textfield',
            '#title' => t('wrapper class'),
            '#size' => 25,
            '#description' => $this->t('Wrapper class for field.'),
            '#default_value' => $myAccountConfigValue['currency_field']['wrapper']
        ];

        $form['field_configuration']['field_labels_first_name'] = [
            '#type' => 'details',
            '#title' => 'First Name',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_first_name']['label'] = [
            '#type' => 'textfield',
            '#title' => t('Label'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the first name Field.'),
            '#default_value' => $myAccountConfigValue['first_name_field']['label']
        ];

        $form['field_configuration']['field_labels_first_name']['required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Required field'),
            '#default_value' => $myAccountConfigValue['first_name_field']['required']
        ];

        $form['field_configuration']['field_labels_first_name']['error'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Error message for First name'),
            '#size' => 100,
            '#default_value' => $myAccountConfigValue['first_name_field']['error']
        ];

        $form['field_configuration']['field_labels_first_name']['weight'] = [
            '#type' => 'select',
            '#title' => $this->t('Field Weight'),
            '#options' => array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'),
            '#default_value' => $myAccountConfigValue['first_name_field']['weight']
        ];

        $form['field_configuration']['field_labels_first_name']['wrapper'] = [
            '#type' => 'textfield',
            '#title' => t('First name wrapper class'),
            '#size' => 25,
            '#description' => $this->t('Wrapper class for field.'),
            '#default_value' => $myAccountConfigValue['first_name_field']['wrapper']
        ];

        $form['field_configuration']['field_labels_last_name'] = [
            '#type' => 'details',
            '#title' => 'Last Name',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_last_name']['label'] = [
            '#type' => 'textfield',
            '#title' => t('Label'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the last name Field.'),
            '#default_value' => $myAccountConfigValue['last_name_field']['label']
        ];

        $form['field_configuration']['field_labels_last_name']['required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Required field'),
            '#default_value' => $myAccountConfigValue['last_name_field']['required']
        ];

        $form['field_configuration']['field_labels_last_name']['error'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Error message for Last name'),
            '#size' => 100,
            '#default_value' => $myAccountConfigValue['last_name_field']['error']
        ];

        $form['field_configuration']['field_labels_last_name']['weight'] = [
            '#type' => 'select',
            '#title' => $this->t('Field Weight'),
            '#options' => array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'),
            '#default_value' => $myAccountConfigValue['last_name_field']['weight']
        ];

        $form['field_configuration']['field_labels_last_name']['wrapper'] = [
            '#type' => 'textfield',
            '#title' => t('Last name wrapper class'),
            '#size' => 25,
            '#description' => $this->t('Wrapper class for field.'),
            '#default_value' => $myAccountConfigValue['last_name_field']['wrapper']
        ];

        $form['field_configuration']['field_labels_dob'] = [
            '#type' => 'details',
            '#title' => 'DOB',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_dob']['label'] = [
            '#type' => 'textfield',
            '#title' => t('Label'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the DOB Field.'),
            '#default_value' => $myAccountConfigValue['dob_field']['label']
        ];

        $form['field_configuration']['field_labels_dob']['required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Required field'),
            '#default_value' => $myAccountConfigValue['dob_field']['required']
        ];

        $form['field_configuration']['field_labels_dob']['error'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Error message for DOB'),
            '#size' => 100,
            '#default_value' => $myAccountConfigValue['dob_field']['error']
        ];

        $form['field_configuration']['field_labels_dob']['weight'] = [
            '#type' => 'select',
            '#title' => $this->t('Field Weight'),
            '#options' => array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'),
            '#default_value' => $myAccountConfigValue['dob_field']['weight']
        ];

        $form['field_configuration']['field_labels_dob']['wrapper'] = [
            '#type' => 'textfield',
            '#title' => t('DOB wrapper class'),
            '#size' => 25,
            '#description' => $this->t('Wrapper class for field.'),
            '#default_value' => $myAccountConfigValue['dob_field']['wrapper']
        ];

        $form['field_configuration']['field_labels_country'] = [
            '#type' => 'details',
            '#title' => 'Country',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_country']['label'] = [
            '#type' => 'textfield',
            '#title' => t('Label'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the country Field.'),
            '#default_value' => $myAccountConfigValue['country_field']['label']
        ];

        $form['field_configuration']['field_labels_country']['required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Required field'),
            '#default_value' => $myAccountConfigValue['country_field']['required']
        ];

        $form['field_configuration']['field_labels_country']['error'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Error message for Country'),
            '#size' => 100,
            '#default_value' => $myAccountConfigValue['country_field']['error']
        ];

        $form['field_configuration']['field_labels_country']['weight'] = [
            '#type' => 'select',
            '#title' => $this->t('Field Weight'),
            '#options' => array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'),
            '#default_value' => $myAccountConfigValue['country_field']['weight']
        ];

        $form['field_configuration']['field_labels_country']['wrapper'] = [
            '#type' => 'textfield',
            '#title' => t('Country wrapper class'),
            '#size' => 25,
            '#description' => $this->t('Wrapper class for field.'),
            '#default_value' => $myAccountConfigValue['country_field']['wrapper']
        ];

        $form['field_configuration']['field_labels_email'] = [
            '#type' => 'details',
            '#title' => 'Email',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_email']['label'] = [
            '#type' => 'textfield',
            '#title' => t('Label'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the email Field.'),
            '#default_value' => $myAccountConfigValue['email_field']['label']
        ];

        $form['field_configuration']['field_labels_email']['required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Required field'),
            '#default_value' => $myAccountConfigValue['email_field']['required']
        ];

        $form['field_configuration']['field_labels_email']['error'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Error message for Email'),
            '#size' => 100,
            '#default_value' => $myAccountConfigValue['email_field']['error']
        ];

        $form['field_configuration']['field_labels_email']['weight'] = [
            '#type' => 'select',
            '#title' => $this->t('Field Weight'),
            '#options' => array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'),
            '#default_value' => $myAccountConfigValue['email_field']['weight']
        ];

        $form['field_configuration']['field_labels_email']['wrapper'] = [
            '#type' => 'textfield',
            '#title' => t('Email wrapper class'),
            '#size' => 25,
            '#description' => $this->t('Wrapper class for field.'),
            '#default_value' => $myAccountConfigValue['email_field']['wrapper']
        ];

        $form['field_configuration']['field_labels_mobile_number'] = [
            '#type' => 'details',
            '#title' => 'Mobile Number',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_mobile_number']['label'] = [
            '#type' => 'textfield',
            '#title' => t('Label'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the mobile number Field.'),
            '#default_value' => $myAccountConfigValue['mobile_number_field']['label']
        ];

        $form['field_configuration']['field_labels_mobile_number']['required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Required field'),
            '#default_value' => $myAccountConfigValue['mobile_number_field']['required']
        ];

        $form['field_configuration']['field_labels_mobile_number']['error'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Error message for Mobile number'),
            '#size' => 100,
            '#default_value' => $myAccountConfigValue['mobile_number_field']['error']
        ];

        $form['field_configuration']['field_labels_mobile_number']['weight'] = [
            '#type' => 'select',
            '#title' => $this->t('Field Weight'),
            '#options' => array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'),
            '#default_value' => $myAccountConfigValue['mobile_number_field']['weight']
        ];

        $form['field_configuration']['field_labels_mobile_number']['wrapper'] = [
            '#type' => 'textfield',
            '#title' => t('Mobile no. wrapper class'),
            '#size' => 25,
            '#description' => $this->t('Wrapper class for field.'),
            '#default_value' => $myAccountConfigValue['mobile_number_field']['wrapper']
        ];

        $form['field_configuration']['field_labels_language'] = [
            '#type' => 'details',
            '#title' => 'Language',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_language']['label'] = [
            '#type' => 'textfield',
            '#title' => t('Label'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the language Field.'),
            '#default_value' => $myAccountConfigValue['language_field']['label']
        ];

        $form['field_configuration']['field_labels_language']['required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Required field'),
            '#default_value' => $myAccountConfigValue['language_field']['required']
        ];

        $form['field_configuration']['field_labels_language']['error'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Error message for Language'),
            '#size' => 100,
            '#default_value' => $myAccountConfigValue['language_field']['error']
        ];

        $form['field_configuration']['field_labels_language']['weight'] = [
            '#type' => 'select',
            '#title' => $this->t('Field Weight'),
            '#options' => array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'),
            '#default_value' => $myAccountConfigValue['language_field']['weight']
        ];
        $form['field_configuration']['field_labels_language']['language_field_help_text'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Help text'),
            '#rows' => 5,
            '#description' => $this->t('Instructions to present to the user below this field on the editing form.'),
            '#default_value' => $myAccountConfigValue['language_field']['language_field_help_text']
        ];

        $form['field_configuration']['field_labels_language']['wrapper'] = [
            '#type' => 'textfield',
            '#title' => t('Language wrapper class'),
            '#size' => 25,
            '#description' => $this->t('Wrapper class for field.'),
            '#default_value' => $myAccountConfigValue['language_field']['wrapper']
        ];

        $form['actions'] = ['#type' => 'actions'];
        // Add a submit button that handles the submission of the form.
        $form['actions']['submit'] = [
            '#type' => 'submit',
            '#value' => $this->t('Submit'),
        ];
        $form['icore'] = [
            '#type' => 'vertical_tabs',
        ];
        $form['field_icore_validation'] = [
            '#type' => 'details',
            '#title' => 'iCore Validation',
            '#group' => 'icore',
            '#open' => TRUE,
            '#tree' => TRUE,
        ];
        $form['field_icore_validation']['confirm_password_error'] = [
            '#type' => 'textfield',
            '#title' => t('Confirm Password Error'),
            '#description' => $this->t('Required Error Message.'),
            '#maxlength' => 255,
            '#default_value' => $myAccountConfigValue['']['confirm_password_error']
        ];
        $form['field_icore_validation']['current_password_error'] = array(
            '#type' => 'textfield',
            '#title' => t('Current Password Error'),
            '#description' => $this->t('Required Error Message.'),
            '#maxlength' => 255,
            '#default_value' => $myAccountConfigValue['']['current_password_error']
        );
        $form['field_icore_validation']['new_password_error'] = [
            '#type' => 'textfield',
            '#title' => t('New Password Error'),
            '#description' => $this->t('Required Error Message.'),
            '#maxlength' => 255,
            '#default_value' => $myAccountConfigValue['']['new_password_error']
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
            ->set('username_field.label', $configuration['field_labels_user_name']['label'])
            ->set('username_field.required', $configuration['field_labels_user_name']['required'])
            ->set('username_field.weight', $configuration['field_labels_user_name']['weight'])
            ->set('username_field.wrapper', $configuration['field_labels_user_name']['wrapper'])
            ->set('currency_field.label', $configuration['field_labels_currency']['label'])
            ->set('currency_field.required', $configuration['field_labels_currency']['required'])
            ->set('currency_field.error', $configuration['field_labels_currency']['error'])
            ->set('currency_field.weight', $configuration['field_labels_currency']['weight'])
            ->set('currency_field.wrapper', $configuration['field_labels_currency']['wrapper'])
            ->set('first_name_field.label', $configuration['field_labels_first_name']['label'])
            ->set('first_name_field.required', $configuration['field_labels_first_name']['required'])
            ->set('first_name_field.error', $configuration['field_labels_first_name']['error'])
            ->set('first_name_field.weight', $configuration['field_labels_first_name']['weight'])
            ->set('first_name_field.wrapper', $configuration['field_labels_first_name']['wrapper'])
            ->set('last_name_field.label', $configuration['field_labels_last_name']['label'])
            ->set('last_name_field.required', $configuration['field_labels_last_name']['required'])
            ->set('last_name_field.error', $configuration['field_labels_last_name']['error'])
            ->set('last_name_field.weight', $configuration['field_labels_last_name']['weight'])
            ->set('last_name_field.wrapper', $configuration['field_labels_last_name']['wrapper'])
            ->set('dob_field.label', $configuration['field_labels_dob']['label'])
            ->set('dob_field.required', $configuration['field_labels_dob']['required'])
            ->set('dob_field.error', $configuration['field_labels_dob']['error'])
            ->set('dob_field.weight', $configuration['field_labels_dob']['weight'])
            ->set('dob_field.wrapper', $configuration['field_labels_dob']['wrapper'])
            ->set('country_field.label', $configuration['field_labels_country']['label'])
            ->set('country_field.required', $configuration['field_labels_country']['required'])
            ->set('country_field.error', $configuration['field_labels_country']['error'])
            ->set('country_field.weight', $configuration['field_labels_country']['weight'])
            ->set('country_field.wrapper', $configuration['field_labels_country']['wrapper'])
            ->set('email_field.label', $configuration['field_labels_email']['label'])
            ->set('email_field.required', $configuration['field_labels_email']['required'])
            ->set('email_field.error', $configuration['field_labels_email']['error'])
            ->set('email_field.weight', $configuration['field_labels_email']['weight'])
            ->set('email_field.wrapper', $configuration['field_labels_email']['wrapper'])
            ->set('mobile_number_field.label', $configuration['field_labels_mobile_number']['label'])
            ->set('mobile_number_field.required', $configuration['field_labels_mobile_number']['required'])
            ->set('mobile_number_field.error', $configuration['field_labels_mobile_number']['error'])
            ->set('mobile_number_field.weight', $configuration['field_labels_mobile_number']['weight'])
            ->set('mobile_number_field.wrapper', $configuration['field_labels_mobile_number']['wrapper'])
            ->set('language_field.label', $configuration['field_labels_language']['label'])
            ->set('language_field.required', $configuration['field_labels_language']['required'])
            ->set('language_field.error', $configuration['field_labels_language']['error'])
            ->set('language_field.weight', $configuration['field_labels_language']['weight'])
            ->set('language_field.language_field_help_text', $configuration['field_labels_language']['language_field_help_text'])
            ->set('language_field.wrapper', $configuration['field_labels_language']['wrapper'])
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
