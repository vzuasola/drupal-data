<?php

namespace Drupal\webcomposer_example\Form;

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
class WebComposerExampleConfigForm extends ConfigFormBase
{

    /**
     * Build the form.
     *
     * @inheritdoc
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {

        $wcSampleConfig = $this->config('webcomposer_example.sample_form');

        $form['sample_form'] = [
            '#type' => 'vertical_tabs',
        ];

        $form['field_configuration'] = [
            '#type' => 'details',
            '#title' => 'Sample Form',
            '#group' => 'sample_form',
            '#open' => true,
            '#tree' => true,
        ];
        $form['field_configuration']['field_labels_labels'] = [
            '#type' => 'details',
            '#title' => 'Sample Fields',
            '#open' => true,
            '#tree' => true,
        ];

        $form['field_configuration']['field_labels_labels']['sample_field_1'] = [
            '#type' => 'textfield',
            '#title' => t('Sample Field 1'),
            '#size' => 25,
            '#required' => true,
            '#description' => $this->t('Sample Field 1 Description'),
            '#default_value' => $wcSampleConfig->get('sample_field_1')
        ];

        $form['field_configuration']['field_labels_labels']['sample_field_2'] = [
            '#type' => 'checkbox',
            '#title' => $this->t('Sample Field 2'),
            '#default_value' => $wcSampleConfig->get('sample_field_2')
        ];

        $form['field_configuration']['field_labels_labels']['sample_field_3'] = [
            '#type' => 'textfield',
            '#title' => $this->t('Sample Field 3'),
            '#size' => 5,
            '#default_value' => $wcSampleConfig->get('sample_field_3')
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
        return 'webcomposer_example_sample_form';
    }

    /**
     *
     * @inheritdoc
     */
    protected function getEditableConfigNames()
    {
        return ['webcomposer_example.sample_form'];
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
        $this->config('webcomposer_example.sample_form')
            ->set('sample_field_1', $configuration['field_labels_labels']['sample_field_1'])
            ->set('sample_field_2', $configuration['field_labels_labels']['sample_field_2'])
            ->set('sample_field_3', $configuration['field_labels_labels']['sample_field_3'])
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
