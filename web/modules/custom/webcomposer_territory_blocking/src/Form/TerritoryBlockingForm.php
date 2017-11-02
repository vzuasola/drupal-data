<?php

namespace Drupal\webcomposer_territory_blocking\Form;

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
class TerritoryBlockingForm extends ConfigFormBase {
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

  /**
   * Build the form.
   *
   * @inheritdoc
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Get Form configuration.
    $territoryBlockingConfig = $this->config('webcomposer_config.territory_blocking');
    $restricted_countries = $territoryBlockingConfig->get('territory_blocking_mapping');

    $form['territory_blocking'] = [
      '#type' => 'vertical_tabs',
    ];

    $form['field_configuration'] = [
      '#type' => 'details',
      '#title' => 'Balance Configuration',
      '#group' => 'territory_blocking',
      '#open' => true,
      '#tree' => true,
    ];

    $form['field_configuration']['territory_blocking_mapping'] = [
      '#type' => 'textarea',
      '#title' => t('Territory Blocking'),
      '#required' => true,
      '#description' => $this->t("Add a key value pair of balance mapping
        <br>
        Format is balance, then comma separated country codes, separated by pipe
        <br>
        <br>
        Example <strong>5|US,CH,PH,SG</strong>
      "),
      '#default_value' => $restricted_countries
    ];

    $form['actions'] = ['#type' => 'actions'];

    // Add a submit button that handles the submission of the form.
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
    ];

    return $form;
  }

  /**
   * Getter method for Form ID.
   *
   * @inheritdoc
   */
  public function getFormId() {
    return 'fapi_territory_blocking_config';
  }

  /**
   *
   * @inheritdoc
   */
  protected function getEditableConfigNames() {
    return ['webcomposer_config.territory_blocking'];
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
    $restricted_countries = $form_state->getValue('field_configuration')['territory_blocking_mapping'];

    $this->config('webcomposer_config.territory_blocking')
        ->set('territory_blocking_mapping', $restricted_countries)
        ->save();
  }
}
