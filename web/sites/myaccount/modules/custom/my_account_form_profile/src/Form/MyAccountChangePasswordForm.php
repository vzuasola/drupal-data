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

        $myAccountConfig = $this->config('my_account_form_profile.change_password');

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

        $form['field_configuration']['field_labels_current']['current_password_label'] = [
            '#type' => 'textfield',
            '#title' => t('Label'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the current password Field.'),
            '#default_value' => $myAccountConfig->get('current_password_label')
        ];

        $form['field_configuration']['field_labels_current']['current_password_help'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Help text'),
            '#rows' => 5,
            '#description' => $this->t('Instructions to present to the user below this field on the editing form.'),
            '#default_value' => $myAccountConfig->get('current_password_help')
        ];

        $form['field_configuration']['field_labels_current']['current_password_required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Required field'),
            '#default_value' => $myAccountConfig->get('current_password_required')
        ];

        $form['field_configuration']['field_labels_current']['field_current_password_default_detail'] = [
            '#type' => 'details',
            '#title' => 'Default value',
            '#description' => $this->t('The default value for this field, used when creating new content.'),
        ];

        $form['field_configuration']['field_labels_current']['field_current_password_default_detail']['field_current_password_default'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Change Password'),
            '#maxlength' => 255,
            '#default_value' => $myAccountConfig->get('field_current_password_default'),
        ];

        $form['field_configuration']['field_labels_current']['current_password_error'] = [
            '#type' => 'textfield',
            '#title' => t('Current Password Error'),
            '#description' => $this->t('Required Error Message.'),
            '#maxlength' => 255,
            '#default_value' => $myAccountConfig->get('current_password_error')
        ];

        $form['field_configuration']['field_labels_new_password'] = [
            '#type' => 'details',
            '#title' => 'New Password',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_new_password']['new_password_label'] = [
            '#type' => 'textfield',
            '#title' => t('Label'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the new password Field.'),
            '#default_value' => $myAccountConfig->get('new_password_label')
        ];

        $form['field_configuration']['field_labels_new_password']['new_password_help'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Help text'),
            '#rows' => 5,
            '#description' => $this->t('Instructions to present to the user below this field on the editing form.'),
            '#default_value' => $myAccountConfig->get('new_password_help')
        ];

        $form['field_configuration']['field_labels_new_password']['new_password_required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Required field'),
            '#default_value' => $myAccountConfig->get('new_password_required')
        ];

        $form['field_configuration']['field_labels_new_password']['field_new_password_default_detail'] = [
            '#type' => 'details',
            '#title' => 'Default value',
            '#description' => $this->t('The default value for this field, used when creating new content.'),
        ];

        $form['field_configuration']['field_labels_new_password']['field_new_password_default_detail']['field_new_password_default'] = [
            '#type' => 'textfield',
            '#title' => $this->t('New Password'),
            '#maxlength' => 255,
            '#default_value' => $myAccountConfig->get('field_new_password_default'),
        ];

        $form['field_configuration']['field_labels_new_password']['new_password_error'] = [
            '#type' => 'textfield',
            '#title' => t('New Password Error'),
            '#description' => $this->t('Required Error Message.'),
            '#maxlength' => 255,
            '#default_value' => $myAccountConfig->get('new_password_error')
        ];
        $form['field_configuration']['field_labels_confirm'] = [
            '#type' => 'details',
            '#title' => 'Confirm Password',
            '#group' => 'confirm_password',
            '#open' => False,
            '#tree' => TRUE,
        ];

        $form['field_configuration']['field_labels_confirm']['confirm_password_label'] = [
            '#type' => 'textfield',
            '#title' => t('Label'),
            '#size' => 25,
            '#required' => TRUE,
            '#description' => $this->t('Label for the confirm password Field.'),
            '#default_value' => $myAccountConfig->get('confirm_password_label')
        ];

        $form['field_configuration']['field_labels_confirm']['confirm_password_help'] = [
            '#type' => 'textarea',
            '#title' => $this->t('Help text'),
            '#rows' => 5,
            '#description' => $this->t('Instructions to present to the user below this field on the editing form.'),
            '#default_value' => $myAccountConfig->get('confirm_password_help')
        ];

        $form['field_configuration']['field_labels_confirm']['confirm_password_required'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Required field'),
            '#default_value' => $myAccountConfig->get('confirm_password_required')
        ];

        $form['field_configuration']['field_labels_confirm']['field_confirm_password_default_detail'] = [
            '#type' => 'details',
            '#title' => 'Default value',
            '#description' => $this->t('The default value for this field, used when creating new content.'),
        ];

        $form['field_configuration']['field_labels_confirm']['field_confirm_password_default_detail']['field_confirm_password_default'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Confirm Password'),
            '#maxlength' => 255,
            '#default_value' => $myAccountConfig->get('field_confirm_password_default'),
        ];

        $form['field_configuration']['field_labels_confirm']['confirm_password_error'] = [
            '#type' => 'textfield',
            '#title' => t('Confirm Password Error'),
            '#description' => $this->t('Required Error Message.'),
            '#maxlength' => 255,
            '#default_value' => $myAccountConfig->get('confirm_password_error')
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
            ->set('current_password_label', $configuration['field_labels_current']['current_password_label'])
            ->set('current_password_help', $configuration['field_labels_current']['current_password_help'])
            ->set('current_password_required', $configuration['field_labels_current']['current_password_required'])
            ->set('field_current_password_default', $configuration['field_labels_current']['field_current_password_default_detail']['field_current_password_default'])
            ->set('current_password_error', $configuration['field_labels_current']['current_password_error'])
            ->set('confirm_password_label', $configuration['field_labels_confirm']['confirm_password_label'])
            ->set('confirm_password_help', $configuration['field_labels_confirm']['confirm_password_help'])
            ->set('confirm_password_required', $configuration['field_labels_confirm']['confirm_password_required'])
            ->set('field_confirm_password_default', $configuration['field_labels_confirm']['field_confirm_password_default_detail']['field_confirm_password_default'])
            ->set('confirm_password_error', $configuration['field_labels_confirm']['confirm_password_error'])
            ->set('new_password_label', $configuration['field_labels_new_password']['new_password_label'])
            ->set('new_password_help', $configuration['field_labels_new_password']['new_password_help'])
            ->set('new_password_required', $configuration['field_labels_new_password']['new_password_required'])
            ->set('field_new_password_default', $configuration['field_labels_new_password']['field_new_password_default_detail']['field_new_password_default'])
            ->set('new_password_error', $configuration['field_labels_new_password']['new_password_error'])
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
