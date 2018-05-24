<?php

namespace Drupal\webcomposer_form_manager\Form;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Component\Utility\SortArray;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\Core\Link;

/**
 * Class List.
 *
 * @package Drupal\webcomposer_form_manager\Form
 */
class ManageForm extends FormBase {
  /**
   * Drupal language manager
   *
   * @var object
   */
  protected $languageManager;

  /**
   * Form manager
   *
   * @var \Drupal\webcomposer_form_manager\WebcomposerForm
   */
  private $formManager;

  /**
   * Current Route
   *
   * @var object
   */
  private $route;

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.typed'),
      $container->get('language_manager'),
      $container->get('webcomposer_form_manager.form_manager'),
      $container->get('current_route_match'),
      $container->get('module_handler')
    );
  }

  /**
   * Class constructor.
   */
  public function __construct($typedConfigManager, $languageManager, $formManager, $route, $moduleHandler) {
    parent::__construct($typedConfigManager, $languageManager, $moduleHandler);

    $this->languageManager = $languageManager;
    $this->formManager = $formManager;
    $this->route = $route;

    $this->entity = $this->getEntity();
  }

  /**
   *
   */
  private function getEntity() {
    $entityId = $this->route->getParameter('form');
    $entity = $this->formManager->getFormById($entityId);

    return $entity;
  }

  /**
   * 
   */
  public function title() {
    $name = $this->entity->getName();

    return $name;
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    $id = $this->entity->getId();

    return [
      "webcomposer_form_manager.form.$id"
    ];
  }

  /**
   * {@inheritdoc}
   */
  protected function getDefaultConfigName() {
    $id = $this->entity->getId();

    return "webcomposer_form_manager.form.$id";
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'webcomposer_form_manager.manage_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // check if the entity exists first
    if (!$this->entity) {
      throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException();
    }

    // display helpful message to remind editors that they are translating a value
    if ($this->isConfigValueOverride()) {
      $this->notify();
    }

    $this->generateSettingsForm($form);
    $this->generateFieldsForm($form);

    return parent::buildForm($form, $form_state);
  }

  /**
   * Notify user that the form is a translate form
   */
  private function notify() {
    $id = $this->entity->getId();

    $lang = $this->languageManager->getCurrentLanguage()->getId();
    $language = $this->languageManager->getDefaultLanguage();

    $uri = new Url('webcomposer_form_manager.form.view', [
      'form' => $id,
      'language' => $language->getId(),
    ], [
      'language' => $language,
    ]);

    $link = Link::fromTextAndUrl(t('Cancel translating'), $uri)->toString();

    drupal_set_message(t("You are translating this configuration to language <strong>$lang</strong>. Go back by <strong>$link</strong>"), 'warning');
  }

  /**
   * Generates the settings form
   */
  protected function generateSettingsForm(&$form) {
    $name = $this->getDefaultConfigName();
    $settings = $this->entity->getSettings();

    if (!empty($settings)) {
      $formSettings = $this->getConfigValues($name, 'form_settings');

      $form['form_settings'] = [
        '#type' => 'details',
        '#title' => 'Form Settings',
        '#open' => TRUE,
        '#tree' => TRUE,
      ];

      foreach ($settings as $key => $value) {
        $form['form_settings'][$key] = $value;

        if (isset($formSettings[$key])) {
          $form['form_settings'][$key]['#default_value'] = $formSettings[$key];
        }
      }
    }
  }

  /**
   * Generates the settings form
   */
  protected function generateFieldsForm(&$form) {
    $id = $this->entity->getId();
    $name = $this->getDefaultConfigName();
    $fields = $this->entity->getFields();
    $header = ['Name', 'Field type', 'Actions', 'Weight'];

    $form['table'] = [
      '#type' => 'table',
      '#header' => $header,
      '#empty' => 'No form to show',
      '#tabledrag' => [
        [
          'action' => 'order',
          'relationship' => 'sibling',
          'group' => 'mytable-order-weight',
        ],
      ],
      '#tree' => TRUE,
    ];

    $i = 0;
    $fieldWeights = $this->getConfigValues($name, 'weights');

    // sort the fields by weights fetched from the save storage
    uasort($fields, function ($a, $b) use ($fieldWeights) {
      $aId = $a->getId();
      $bId = $b->getId();

      if (isset($fieldWeights[$aId]) && isset($fieldWeights[$bId])) {
        return SortArray::sortByKeyInt($fieldWeights[$aId], $fieldWeights[$bId], 'weight');
      }
    });

    foreach ($fields as $key => $field) {
      $url = new Url('webcomposer_form_manager.field.view', [
        'form' => $id,
        'field' => $field->getId(),
      ]);

      $form['table'][$key]['title'] = [
        '#markup' => $field->getName(),
      ];

      $form['table'][$key]['type'] = [
        '#markup' => ucwords($field->getType()),
      ];

      if ($field->getSettings()) {
        $operations = [
          'data' => [
            '#type' => 'operations',
            '#links' => [
              'edit' => [
                'url' => $url,
                'title' => 'Edit'
              ],
            ],
          ],
        ];

        $form['table'][$key]['actions'] = $operations;
      } else {
        $form['table'][$key]['actions'] = [
          '#markup' => 'No Actions',
        ];
      }

      $weight = $fieldWeights[$key]['weight'] ?? ++ $i;

      $form['table'][$key]['weight'] = [
        '#type' => 'weight',
        '#title' => 'Weight',
        '#title_display' => 'invisible',
        '#default_value' => $weight,
        '#attributes' => ['class' => ['mytable-order-weight']],
      ];

      $form['table'][$key]['#weight'] = $weight;
      $form['table'][$key]['#attributes']['class'][] = 'draggable';
    }
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   *
   * @todo Add saving of field orders here
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    parent::submitForm($form, $form_state);
    
    $this->saveFormSettings($form, $form_state);
    $this->saveFieldWeights($form, $form_state);
  }

  /**
   * Save form settings
   */
  protected function saveFormSettings($form, FormStateInterface $form_state) {
    $name = $this->getDefaultConfigName();

    $data = $form_state->getValue('form_settings');

    $this->saveRawConfigValue($name, 'form_settings', $data);
  }

  /**
   * Save weights of the field
   */
  protected function saveFieldWeights($form, FormStateInterface $form_state) {
    $name = $this->getDefaultConfigName();

    $weights = [];
    $data = $form_state->getValue('table');

    foreach ($data as $key => $value) {
      $weights[$key]['weight'] = $value['weight'];
    }

    $this->saveRawConfigValue($name, 'weights', $weights);
  }
}
