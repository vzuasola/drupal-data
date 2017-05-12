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
class MyAccountChangePasswordForm extends ConfigFormBase
{

    /**
     * Build the form.
     *
     * @inheritdoc
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {

        // Get Form configuration.
        $myAccountConfig = $this->config('my_account_form_profile.change_password');
        $myAccountConfigValue = $myAccountConfig->get();

        $form['change_password'] = [
            '#type' => 'vertical_tabs',
        ];

        $form['field_configuration'] = [
            '#type' => 'details',
            '#title' => 'Field Configuration',
            '#group' => 'change_password',
            '#open' => TRUE,
            '#tree' => TRUE,
        ];
        $form['field_configuration']['field_labels_current'] = [
            '#type' => 'details',
            '#title' => 'Current Password',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_current']['label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Label'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the current password Field.'),
            '#default_value' => $myAccountConfigValue['current_password_field']['options']['label']
        ];

        $form['field_configuration']['field_labels_current']['help'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Help text'),
            '#rows' => 5,
            '#description' => $this->t('Instructions to present to the user below this field on the editing form.'),
            '#default_value' => $myAccountConfigValue['current_password_field']['options']['help']
        ];

        $form['field_configuration']['field_labels_current']['required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Required field'),
            '#default_value' => $myAccountConfigValue['current_password_field']['options']['required']
        ];

        $form['field_configuration']['field_labels_current']['default_detail'] = [
            '#type' => 'details',
            '#title' => 'Field Placeholder',
            '#description' => $this->t('The default value for this field, used when creating new content.'),
        ];

        $form['field_configuration']['field_labels_current']['default_detail']['placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Current Password'),
            '#maxlength' => 255,
            '#default_value' => $myAccountConfigValue['current_password_field']['options']['attr']['placeholder'],
        ];

        $form['field_configuration']['field_labels_current']['weight'] = [
            '#type' => 'select',
            '#title' => $this->t('Field weight'),
            '#options' => array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'),
            '#default_value' => $myAccountConfigValue['current_password_field']['weight']
        ];

        $form['field_configuration']['field_labels_current']['wrapper_class'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Current password wrapper'),
            '#size' => 25,
            '#description' => $this->t('Wrapper class for field.'),
            '#default_value' => $myAccountConfigValue['current_password_field']['options']['wrapper_class']
        ];

        $form['field_configuration']['field_labels_new_password'] = [
            '#type' => 'details',
            '#title' => 'New Password',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_new_password']['label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Label'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the new password Field.'),
            '#default_value' => $myAccountConfigValue['new_password_field']['options']['label']
        ];

        $form['field_configuration']['field_labels_new_password']['help'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Help text'),
            '#rows' => 5,
            '#description' => $this->t('Instructions to present to the user below this field on the editing form.'),
            '#default_value' => $myAccountConfigValue['new_password_field']['options']['help']
        ];

        $form['field_configuration']['field_labels_new_password']['required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Required field'),
            '#default_value' => $myAccountConfigValue['new_password_field']['options']['required']
        ];

        $form['field_configuration']['field_labels_new_password']['default_detail'] = [
            '#type' => 'details',
            '#title' => 'Field Placeholder',
            '#description' => $this->t('The default value for this field, used when creating new content.'),
        ];

        $form['field_configuration']['field_labels_new_password']['default_detail']['placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('New Password'),
            '#maxlength' => 255,
            '#default_value' => $myAccountConfigValue['new_password_field']['options']['attr']['placeholder'],
        ];

        $form['field_configuration']['field_labels_new_password']['weight'] = [
            '#type' => 'select',
            '#title' => $this->t('Field weight'),
            '#options' => array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'),
            '#default_value' => $myAccountConfigValue['new_password_field']['weight']
        ];

        $form['field_configuration']['field_labels_new_password']['wrapper_class'] = [
            '#type' => 'textfield',
            '#title' => $this->t('New password wrapper'),
            '#size' => 25,
            '#description' => $this->t('Wrapper class for field.'),
            '#default_value' => $myAccountConfigValue['new_password_field']['options']['wrapper_class']
        ];

        $form['field_configuration']['field_labels_confirm'] = [
            '#type' => 'details',
            '#title' => 'Confirm Password',
            '#group' => 'confirm_password',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_confirm']['label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Label'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the confirm password Field.'),
            '#default_value' => $myAccountConfigValue['confirm_password_field']['options']['label']
        ];

        $form['field_configuration']['field_labels_confirm']['help'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Help text'),
            '#rows' => 5,
            '#description' => $this->t('Instructions to present to the user below this field on the editing form.'),
            '#default_value' => $myAccountConfigValue['confirm_password_field']['options']['help']
        ];

        $form['field_configuration']['field_labels_confirm']['required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Required field'),
            '#default_value' => $myAccountConfigValue['confirm_password_field']['options']['required']
        ];

        $form['field_configuration']['field_labels_confirm']['default_detail'] = [
            '#type' => 'details',
            '#title' => 'Field Placeholder',
            '#description' => $this->t('The default value for this field, used when creating new content.'),
        ];

        $form['field_configuration']['field_labels_confirm']['default_detail']['placeholder'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Confirm Password'),
            '#maxlength' => 255,
            '#default_value' => $myAccountConfigValue['confirm_password_field']['options']['attr']['placeholder'],
        ];

        $form['field_configuration']['field_labels_confirm']['weight'] = [
            '#type' => 'select',
            '#title' => $this->t('Field weight'),
            '#options' => array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'),
            '#default_value' => $myAccountConfigValue['confirm_password_field']['weight']
        ];

        $form['field_configuration']['field_labels_confirm']['wrapper_class'] = [
            '#type' => 'textfield',
            '#title' => $this->t('New password wrapper'),
            '#size' => 25,
            '#description' => $this->t('Wrapper class for field.'),
            '#default_value' => $myAccountConfigValue['confirm_password_field']['options']['wrapper_class']
        ];

        $form['field_configuration']['field_submit_button_labels'] = [
            '#type' => 'details',
            '#title' => 'Submit Button',
            '#group' => 'submit_button',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_submit_button_labels']['label'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Submit Button'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the Submit button Field.'),
            '#default_value' => $myAccountConfigValue['submit_button_label_field']['options']['label']
        ];

        $form['field_configuration']['field_icore_validation'] = [
            '#type' => 'details',
            '#title' => 'Integration Validation',
            '#group' => 'change_password',
        ];

        $form['field_configuration']['field_icore_validation']['integration_error'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Integration Error Messages'),
            '#description' => $this->t('Integration error list.'),
            '#default_value' => $myAccountConfigValue['integration_error_messages']['key_messages']
        ];

        $form['field_configuration']['error_detail'] = [
            '#type' => 'details',
            '#title' => 'Validation Error',
            '#description' => $this->t('The default value for this field, used when creating new content.'),
        ];

        $form['field_configuration']['error_detail']['required_error'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Required Error'),
            '#maxlength' => 255,
            '#default_value' => $myAccountConfigValue['validation_error']['required_error'],
        ];

        $form['field_configuration']['error_detail']['minlength_error'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Minlength Error'),
            '#maxlength' => 255,
            '#default_value' => $myAccountConfigValue['validation_error']['minlength_error'],
        ];

        $form['field_configuration']['error_detail']['mismatch'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Mismatch Error'),
            '#maxlength' => 255,
            '#default_value' => $myAccountConfigValue['validation_error']['mismatch'],
        ];

        $form['field_configuration']['error_detail']['maxlength_error'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Maxlength Error'),
            '#maxlength' => 255,
            '#default_value' => $myAccountConfigValue['validation_error']['maxlength_error'],
        ];
        $form['field_configuration']['error_detail']['not_username'] = [
            '#type' => 'textfield',
            '#title' => $this->t('NOT accept the username'),
            '#maxlength' => 255,
            '#default_value' => $myAccountConfigValue['validation_error']['not_username'],
        ];

        $form['field_configuration']['error_detail']['not_password'] = [
            '#type' => 'textfield',
            '#title' => $this->t('NOT accept the word password'),
            '#maxlength' => 255,
            '#default_value' => $myAccountConfigValue['validation_error']['not_password'],
        ];

        $form['field_configuration']['error_detail']['format_error'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Format Error'),
            '#maxlength' => 255,
            '#default_value' => $myAccountConfigValue['validation_error']['format_error'],
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
        return ['my_account_form_profile.change_password'];
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
        $this->config('my_account_form_profile.change_password')
            ->set('current_password_field.options.label', $configuration['field_labels_current']['label'])
            ->set('current_password_field.options.help', $configuration['field_labels_current']['help'])
            ->set('current_password_field.options.required', $configuration['field_labels_current']['required'])
            ->set('current_password_field.weight', $configuration['field_labels_current']['weight'])
            ->set('current_password_field.options.wrapper_class', $configuration['field_labels_current']['wrapper_class'])
            ->set('current_password_field.options.attr.placeholder', $configuration['field_labels_current']['default_detail']['placeholder'])
            ->set('confirm_password_field.options.label', $configuration['field_labels_confirm']['label'])
            ->set('confirm_password_field.options.help', $configuration['field_labels_confirm']['help'])
            ->set('confirm_password_field.weight', $configuration['field_labels_confirm']['weight'])
            ->set('confirm_password_field.options.wrapper_class', $configuration['field_labels_confirm']['wrapper_class'])
            ->set('confirm_password_field.options.required', $configuration['field_labels_confirm']['required'])
            ->set('confirm_password_field.options.attr.placeholder', $configuration['field_labels_confirm']['default_detail']['placeholder'])
            ->set('validation_error.required_error', $configuration['error_detail']['required_error'])
            ->set('validation_error.minlength_error', $configuration['error_detail']['minlength_error'])
            ->set('validation_error.mismatch', $configuration['error_detail']['mismatch'])
            ->set('validation_error.maxlength_error', $configuration['error_detail']['maxlength_error'])
            ->set('validation_error.not_username', $configuration['error_detail']['not_username'])
            ->set('validation_error.not_password', $configuration['error_detail']['not_password'])
            ->set('validation_error.format_error', $configuration['error_detail']['format_error'])
            ->set('new_password_field.options.label', $configuration['field_labels_new_password']['label'])
            ->set('new_password_field.options.help', $configuration['field_labels_new_password']['help'])
            ->set('new_password_field.options.required', $configuration['field_labels_new_password']['required'])
            ->set('new_password_field.options.attr.placeholder', $configuration['field_labels_new_password']['default_detail']['placeholder'])
            ->set('new_password_field.weight', $configuration['field_labels_new_password']['weight'])
            ->set('new_password_field.options.wrapper_class', $configuration['field_labels_new_password']['wrapper_class'])
            ->set('submit_button_label_field.options.label', $configuration['field_submit_button_labels']['label'])
            ->set('integration_error_messages.key_messages', $configuration['field_icore_validation']['integration_error'])
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
