<?php

namespace Drupal\my_account_error_handler\Form;

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
class MyAccountAccessDeniedForm extends ConfigFormBase
{

    /**
     * Build the form.
     *
     * @inheritdoc
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {

        // Get Form configuration.
        $myAccountAccessDeniedConfig = $this->config('my_account_error_handler.403');

        $form['access_denied'] = [
            '#type' => 'vertical_tabs',
        ];

        $form['field_configuration'] = [
            '#type' => 'details',
            '#title' => 'Field Configuration',
            '#group' => 'access_denied',
            '#open' => true,
            '#tree' => true,
        ];

        $form['field_configuration']['access_denied']['top_blurb'] = [
            '#type' => 'textarea',
            '#title' => t('Top Blurb'),
            '#required' => true,
            '#description' => $this->t('Top Blurb'),
            '#default_value' => $myAccountAccessDeniedConfig->get('top_blurb')
        ];

        $form['field_configuration']['access_denied']['bottom_blurb'] = [
            '#type' => 'textarea',
            '#title' => t('Bottom Blurb'),
            '#required' => true,
            '#description' => $this->t('Bottom Blurb'),
            '#default_value' => $myAccountAccessDeniedConfig->get('bottom_blurb')
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
    public function getFormId()
    {
        return 'fapi_access_denied_config';
    }

    /**
     *
     * @inheritdoc
     */
    protected function getEditableConfigNames()
    {
        return ['my_account_error_handler.403'];
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
        $this->config('my_account_error_handler.403')
            ->set('top_blurb', $configuration['access_denied']['top_blurb'])
            ->set('bottom_blurb', $configuration['access_denied']['bottom_blurb'])
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
