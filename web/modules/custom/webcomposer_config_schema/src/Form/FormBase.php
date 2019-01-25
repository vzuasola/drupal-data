<?php

namespace Drupal\webcomposer_config_schema\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class FormBase extends ConfigFormBase {
  use SchemaTrait;
  use SubmitTrait;

  /**
   * Flag to disable auto translate
   *
   * @var boolean
   */
  protected $disableAutoTranslateOnSave = FALSE;

  /**
   * The abstracted form definition method
   *
   * @param array $form
   * @param FormStateInterface $form_state
   *
   * @return array
   */
  abstract public function form(array $form, FormStateInterface $form_state);

  /**
   * The abstracted form submit method
   *
   * @param array $form
   * @param FormStateInterface $form_state
   *
   * @return array
   */
  // abstract public function submit(array &$form, FormStateInterface $form_state);

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'webcomposer_config_schema_form_base';
  }

  /**
   * Class constructor.
   */
  public function __construct($schema_base, $plugin_manager, $language_manager) {
    $this->schemaBase = $schema_base;
    $this->pluginManager = $plugin_manager;
    $this->languageManager = $language_manager;

    $this->processConfigObject();
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('webcomposer_config_schema.schema'),
      $container->get('plugin.manager.webcomposer_config_plugin'),
      $container->get('language_manager')
    );
  }

  /**
   * Processes the config object
   */
  private function processConfigObject() {
    $editables = $this->getEditableConfigNames();

    $this->schemaBase->setEditableConfigNames($editables);
  }

  /**
   *
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = $this->form($form, $form_state);
    $editables = $this->getEditableConfigNames();

    $form['#editable_config_names'] = $editables;

    if ($this->isTranslated()) {
      $this->processForm($form);
    }

    $build = parent::buildForm($form, $form_state);

    $main = reset($editables);
    $lang = $this->languageManager->getCurrentLanguage()->getId();
    $hasTranslations = $this->schemaBase->getConfigValuesByLanguage($main, $lang);

    if ($this->isTranslated() && !empty($hasTranslations)) {
      $build['actions']['reset'] = [
        '#type' => 'submit',
        '#value' => 'Reset Translation',
        '#submit' => ['::resetForm'],
      ];
    }

    return $build;
  }

  /**
   *
   */
  public function resetForm(array $form, FormStateInterface $form_state) {
    $editables = $this->getEditableConfigNames();
    $main = reset($editables);

    $this->schemaBase->deleteConfigValues($main);

    drupal_set_message($this->t('The translation has been deleted.'));
  }

  /**
   *
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    if ($this->isTranslated() && !$this->disableAutoTranslateOnSave) {
      $this->processFormState($this->form([], $form_state), $form_state);
    }

    $this->submit($form, $form_state);

    return parent::submitForm($form, $form_state);
  }

  /**
   *
   */
  private function processFormState($form, FormStateInterface $form_state) {
    foreach ($form as $key => $value) {
      if (is_array($value)) {
        if (isset($value['#type']) && isset($value['#default_value']) && empty($value['#translatable'])) {
          $form_state->unsetValue($key);
        }

        $this->processFormState($form[$key], $form_state);
      }
    }
  }

  /**
   *
   */
  private function processForm(&$form) {
    foreach ($form as $key => $value) {
      if (is_array($value)) {
        if (isset($value['#type']) && isset($value['#default_value']) && empty($value['#translatable'])) {
          $form[$key]['#disabled'] = TRUE;
        }

        $this->processForm($form[$key]);
      }
    }
  }
}
