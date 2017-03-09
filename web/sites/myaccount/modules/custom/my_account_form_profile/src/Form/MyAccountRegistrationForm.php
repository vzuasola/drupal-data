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

        $myAccountConfig = $this->config('my_account_form_profile.profile');

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

        $form['field_configuration']['field_labels_user_name']['user_name_field_label'] = [
            '#type' => 'textfield',
            '#title' => t('Label'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the username Field.'),
            '#default_value' => $myAccountConfig->get('user_name_field_label')
        ];

        $form['field_configuration']['field_labels_user_name']['user_name_field_required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Required field'),
            '#default_value' => $myAccountConfig->get('user_name_field_required')
        ];

        $form['field_configuration']['field_labels_user_name']['user_name_field_weight'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Field weight'),
            '#size' => 5,
            '#default_value' => $myAccountConfig->get('user_name_field_weight')
        ];

        $form['field_configuration']['field_labels_currency'] = [
            '#type' => 'details',
            '#title' => 'Currency',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_currency']['currency_field_label'] = [
            '#type' => 'textfield',
            '#title' => t('Label'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the currency Field.'),
            '#default_value' => $myAccountConfig->get('currency_field_required')
        ];

        $form['field_configuration']['field_labels_currency']['currency_field_required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Required field'),
            '#default_value' => $myAccountConfig->get('currency_field_required')
        ];

        $form['field_configuration']['field_labels_currency']['currency_field_error'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Error message for currency'),
            '#size' => 100,
            '#default_value' => $myAccountConfig->get('currency_field_error')
        ];

        $form['field_configuration']['field_labels_currency']['currency_field_weight'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Field Weight'),
            '#size' => 5,
            '#default_value' => $myAccountConfig->get('currency_field_weight')
        ];

        $form['field_configuration']['field_labels_first_name'] = [
            '#type' => 'details',
            '#title' => 'First Name',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_first_name']['first_name_field_label'] = [
            '#type' => 'textfield',
            '#title' => t('Label'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the first name Field.'),
            '#default_value' => $myAccountConfig->get('first_name_field_label')
        ];

        $form['field_configuration']['field_labels_first_name']['first_name_field_required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Required field'),
            '#default_value' => $myAccountConfig->get('first_name_field_required')
        ];

        $form['field_configuration']['field_labels_first_name']['first_name_field_error'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Error message for First name'),
            '#size' => 100,
            '#default_value' => $myAccountConfig->get('first_name_field_error')
        ];

        $form['field_configuration']['field_labels_first_name']['first_name_field_weight'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Field Weight'),
            '#size' => 5,
            '#default_value' => $myAccountConfig->get('first_name_field_weight')
        ];

        $form['field_configuration']['field_labels_last_name'] = [
            '#type' => 'details',
            '#title' => 'Last Name',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_last_name']['last_name_field_label'] = [
            '#type' => 'textfield',
            '#title' => t('Label'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the last name Field.'),
            '#default_value' => $myAccountConfig->get('last_name_field_label')
        ];

        $form['field_configuration']['field_labels_last_name']['last_name_field_required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Required field'),
            '#default_value' => $myAccountConfig->get('last_name_field_required')
        ];

        $form['field_configuration']['field_labels_last_name']['last_name_field_error'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Error message for Last name'),
            '#size' => 100,
            '#default_value' => $myAccountConfig->get('last_name_field_error')
        ];

        $form['field_configuration']['field_labels_last_name']['last_name_field_weight'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Field Weight'),
            '#size' => 5,
            '#default_value' => $myAccountConfig->get('last_name_field_weight')
        ];
        $form['field_configuration']['field_labels_dob'] = [
            '#type' => 'details',
            '#title' => 'DOB',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_dob']['dob_field_label'] = [
            '#type' => 'textfield',
            '#title' => t('Label'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the DOB Field.'),
            '#default_value' => $myAccountConfig->get('dob_field_label')
        ];

        $form['field_configuration']['field_labels_dob']['dob_field_required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Required field'),
            '#default_value' => $myAccountConfig->get('dob_field_required')
        ];

        $form['field_configuration']['field_labels_dob']['dob_field_error'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Error message for DOB'),
            '#size' => 100,
            '#default_value' => $myAccountConfig->get('dob_field_error')
        ];

        $form['field_configuration']['field_labels_dob']['dob_field_weight'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Field Weight'),
            '#size' => 5,
            '#default_value' => $myAccountConfig->get('dob_field_weight')
        ];
        $form['field_configuration']['field_labels_country'] = [
            '#type' => 'details',
            '#title' => 'Country',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_country']['country_field_label'] = [
            '#type' => 'textfield',
            '#title' => t('Label'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the country Field.'),
            '#default_value' => $myAccountConfig->get('country_field_label')
        ];

        $form['field_configuration']['field_labels_country']['country_field_required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Required field'),
            '#default_value' => $myAccountConfig->get('country_field_required')
        ];

        $form['field_configuration']['field_labels_country']['country_field_error'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Error message for Country'),
            '#size' => 100,
            '#default_value' => $myAccountConfig->get('country_field_error')
        ];

        $form['field_configuration']['field_labels_country']['country_field_weight'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Field Weight'),
            '#size' => 5,
            '#default_value' => $myAccountConfig->get('country_field_weight')
        ];

        $form['field_configuration']['field_labels_email'] = [
            '#type' => 'details',
            '#title' => 'Email',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_email']['email_field_label'] = [
            '#type' => 'textfield',
            '#title' => t('Label'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the email Field.'),
            '#default_value' => $myAccountConfig->get('email_field_label')
        ];

        $form['field_configuration']['field_labels_email']['email_field_required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Required field'),
            '#default_value' => $myAccountConfig->get('email_field_required')
        ];

        $form['field_configuration']['field_labels_email']['email_field_error'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Error message for Email'),
            '#size' => 100,
            '#default_value' => $myAccountConfig->get('email_field_error')
        ];

        $form['field_configuration']['field_labels_email']['email_field_weight'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Field Weight'),
            '#size' => 5,
            '#default_value' => $myAccountConfig->get('email_field_weight')
        ];

        $form['field_configuration']['field_labels_mobile_number'] = [
            '#type' => 'details',
            '#title' => 'Mobile Number',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_mobile_number']['mobile_number_field_label'] = [
            '#type' => 'textfield',
            '#title' => t('Label'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the mobile number Field.'),
            '#default_value' => $myAccountConfig->get('mobile_number_field_label')
        ];

        $form['field_configuration']['field_labels_mobile_number']['mobile_number_field_required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Required field'),
            '#default_value' => $myAccountConfig->get('mobile_number_field_required')
        ];

        $form['field_configuration']['field_labels_mobile_number']['mobile_number_field_error'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Error message for Mobile number'),
            '#size' => 100,
            '#default_value' => $myAccountConfig->get('mobile_number_field_error')
        ];

        $form['field_configuration']['field_labels_mobile_number']['mobile_number_field_weight'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Field Weight'),
            '#size' => 5,
            '#default_value' => $myAccountConfig->get('mobile_number_field_weight')
        ];

        $form['field_configuration']['field_labels_language'] = [
            '#type' => 'details',
            '#title' => 'Language',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_language']['language_field_label'] = [
            '#type' => 'textfield',
            '#title' => t('Label'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the language Field.'),
            '#default_value' => $myAccountConfig->get('language_field_label')
        ];

        $form['field_configuration']['field_labels_language']['language_field_required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Required field'),
            '#default_value' => $myAccountConfig->get('language_field_required')
        ];

        $form['field_configuration']['field_labels_language']['language_field_error'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Error message for Language'),
            '#size' => 100,
            '#default_value' => $myAccountConfig->get('language_field_error')
        ];

        $form['field_configuration']['field_labels_language']['language_field_weight'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Field Weight'),
            '#size' => 5,
            '#default_value' => $myAccountConfig->get('language_number_field_weight')
        ];
        $form['field_configuration']['field_labels_language']['language_field_help_text'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Help text'),
            '#rows' => 5,
            '#description' => $this->t('Instructions to present to the user below this field on the editing form.'),
            '#default_value' => $myAccountConfig->get('language_field_help_text')
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
            '#default_value' => $myAccountConfig->get('confirm_password_error')
        ];
        $form['field_icore_validation']['current_password_error'] = array(
            '#type' => 'textfield',
            '#title' => t('Current Password Error'),
            '#description' => $this->t('Required Error Message.'),
            '#maxlength' => 255,
            '#default_value' => $myAccountConfig->get('current_password_error')
        );
        $form['field_icore_validation']['new_password_error'] = [
            '#type' => 'textfield',
            '#title' => t('New Password Error'),
            '#description' => $this->t('Required Error Message.'),
            '#maxlength' => 255,
            '#default_value' => $myAccountConfig->get('new_password_error')
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
            ->set('user_name_field_label', $configuration['field_labels_user_name']['user_name_field_label'])
            ->set('user_name_field_required', $configuration['field_labels_user_name']['user_name_field_required'])
            ->set('user_name_field_weight', $configuration['field_labels_user_name']['user_name_field_weight'])
            ->set('currency_field_label', $configuration['field_labels_currency']['currency_field_label'])
            ->set('currency_field_required', $configuration['field_labels_currency']['currency_field_required'])
            ->set('currency_field_error', $configuration['field_labels_currency']['currency_field_error'])
            ->set('currency_field_weight', $configuration['field_labels_currency']['currency_field_weight'])
            ->set('first_name_field_label', $configuration['field_labels_first_name']['first_name_field_label'])
            ->set('first_name_field_required', $configuration['field_labels_first_name']['first_name_field_required'])
            ->set('first_name_field_error', $configuration['field_labels_first_name']['first_name_field_error'])
            ->set('first_name_field_weight', $configuration['field_labels_first_name']['first_name_field_weight'])
            ->set('last_name_field_label', $configuration['field_labels_last_name']['last_name_field_label'])
            ->set('last_name_field_required', $configuration['field_labels_last_name']['last_name_field_required'])
            ->set('last_name_field_error', $configuration['field_labels_last_name']['last_name_field_error'])
            ->set('last_name_field_weight', $configuration['field_labels_last_name']['last_name_field_weight'])
            ->set('dob_field_label', $configuration['field_labels_dob']['dob_field_label'])
            ->set('dob_field_required', $configuration['field_labels_dob']['dob_field_required'])
            ->set('dob_field_error', $configuration['field_labels_dob']['dob_field_error'])
            ->set('dob_field_weight', $configuration['field_labels_dob']['dob_field_weight'])
            ->set('country_field_label', $configuration['field_labels_country']['country_field_label'])
            ->set('country_field_required', $configuration['field_labels_country']['country_field_required'])
            ->set('country_field_error', $configuration['field_labels_country']['country_field_error'])
            ->set('country_field_weight', $configuration['field_labels_country']['country_field_weight'])
            ->set('email_field_label', $configuration['field_labels_email']['email_field_label'])
            ->set('email_field_required', $configuration['field_labels_email']['email_field_required'])
            ->set('email_field_error', $configuration['field_labels_email']['email_field_error'])
            ->set('email_field_weight', $configuration['field_labels_email']['email_field_weight'])
            ->set('mobile_number_field_label', $configuration['field_labels_mobile_number']['mobile_number_field_label'])
            ->set('mobile_number_field_required', $configuration['field_labels_mobile_number']['mobile_number_field_required'])
            ->set('mobile_number_field_error', $configuration['field_labels_mobile_number']['mobile_number_field_error'])
            ->set('mobile_number_field_weight', $configuration['field_labels_mobile_number']['mobile_number_field_weight'])
            ->set('language_field_label', $configuration['field_labels_language']['language_field_label'])
            ->set('language_field_required', $configuration['field_labels_language']['language_field_required'])
            ->set('language_field_error', $configuration['field_labels_language']['language_field_error'])
            ->set('language_field_weight', $configuration['field_labels_language']['language_field_weight'])
            ->set('language_field_help_text', $configuration['field_labels_language']['language_field_help_text'])
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
