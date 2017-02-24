<?php

namespace Drupal\my_account\Form;

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
class ChangePassword extends ConfigFormBase {

  /**
   * Build the form.
   *
   * @inheritdoc
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $myAccountConfig = $this->config('my_account.change_password');

    $form['change_password'] = [
      '#type' => 'vertical_tabs',
    ];

    $form['field_labels'] = [
      '#type' => 'details',
      '#title' => 'Field Labels',
      '#group' => 'change_password',
    ];

    $form['field_labels']['fl_current_password'] = [
      '#type' => 'textfield',
      '#title' => t('Current Password'),
      '#default_value' => $myAccountConfig->get('fl_current_password')
    ];

    $form['field_labels']['fl_new_password'] = [
      '#type' => 'textfield',
      '#title' => t('New Password'),
      '#default_value' => $myAccountConfig->get('fl_new_password')
    ];


    $form['field_labels']['fl_confirm_password'] = [
      '#type' => 'textfield',
      '#title' => t('Confirm Password'),
      '#default_value' => $myAccountConfig->get('fl_confirm_password')
    ];

    $form['validation'] = [
      '#type' => 'details',
      '#title' => t('Validation'),
      '#group' => 'change_password',
    ];

    $form['validation']['vl_old_password'] = [
      '#title' => t('Old Password'),
      '#type' => 'details',
      '#open' => true
    ];

    $form['validation']['vl_old_password']['vl_op_required'] = [
      '#title' => t('Required?'),
      '#type' => 'checkbox',
      '#default_value' => $myAccountConfig->get('vl_op_required')
    ];

    $form['validation']['vl_old_password']['vl_op_required_err_message'] = [
      '#title' => t('Required Error Message'),
      '#type' => 'textfield',
      '#default_value' => $myAccountConfig->get('vl_op_required_err_message')
    ];

    $form['validation']['vl_old_password']['vl_op_length'] = [
      '#title' => t('Min and Max Length'),
      '#description' => t('Format: num - num, ex 1-4'),
      '#type' => 'textfield',
      '#default_value' => $myAccountConfig->get('vl_op_length')
    ];

     $form['validation']['vl_old_password']['vl_op_length_err_message'] = [
      '#title' => t('Min/Max Error Message'),
      '#type' => 'textfield',
      '#default_value' => $myAccountConfig->get('vl_op_length_err_message')
    ];

    $form['validation']['vl_new_password'] = [
      '#title' => t('New Password'),
      '#type' => 'details',
      '#open' => true
    ];

    $form['validation']['vl_new_password']['vl_np_required'] = [
      '#title' => t('Required?'),
      '#type' => 'checkbox',
      '#default_value' => $myAccountConfig->get('vl_np_required')
    ];

    $form['validation']['vl_new_password']['vl_np_required_err_message'] = [
      '#title' => t('Required Error Message'),
      '#type' => 'textfield',
      '#default_value' => $myAccountConfig->get('vl_np_required_err_message')
    ];

    $form['validation']['vl_new_password']['vl_np_length'] = [
      '#title' => t('Min and Max Length'),
      '#description' => t('Format: num - num, ex 1-4'),
      '#type' => 'textfield',
      '#default_value' => $myAccountConfig->get('vl_np_length')
    ];

     $form['validation']['vl_new_password']['vl_np_length_err_message'] = [
      '#title' => t('Min/Max Error Message'),
      '#type' => 'textfield',
      '#default_value' => $myAccountConfig->get('vl_np_length_err_message')
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
  public function getFormId() {
    return 'fapi_change_password_config';
  }

  /**
   *
   * @inheritdoc
   */
  protected function getEditableConfigNames() {
    return ['my_account.change_password'];
  }


  /**
   * Implements a form submit handler.
   *
   * @param array $form
   *   The render array of the currently built form.
   * @param FormStateInterface $form_state
   *   Object describing the current state of the form.
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
     $this->config('my_account.change_password')
      ->set('fl_current_password', $form_state->getValue('fl_current_password'))
      ->set('fl_new_password', $form_state->getValue('fl_new_password'))
      ->set('fl_confirm_password', $form_state->getValue('fl_confirm_password'))
      ->set('vl_op_required', $form_state->getValue('vl_op_required'))
      ->set('vl_op_required_err_message', $form_state->getValue('vl_op_required_err_message'))
      ->set('vl_op_length', $form_state->getValue('vl_op_length'))
      ->set('vl_op_length_err_message', $form_state->getValue('vl_op_length_err_message'))
      ->set('vl_np_required', $form_state->getValue('vl_np_required'))
      ->set('vl_np_required_err_message', $form_state->getValue('vl_np_required_err_message'))
      ->set('vl_np_length', $form_state->getValue('vl_np_length'))
      ->set('vl_np_length_err_message', $form_state->getValue('vl_np_length_err_message'))
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
  public function __construct(ConfigFactoryInterface $config_factory, AliasManagerInterface $alias_manager, PathValidatorInterface $path_validator, RequestContext $request_context) {
    parent::__construct($config_factory);

    $this->aliasManager = $alias_manager;
    $this->pathValidator = $path_validator;
    $this->requestContext = $request_context;
  }

    /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.factory'),
      $container->get('path.alias_manager'),
      $container->get('path.validator'),
      $container->get('router.request_context')
    );
  }

}
