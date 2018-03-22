<?php

namespace Drupal\webcomposer_config_schema\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

abstract class FormBase extends ConfigFormBase {
  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'webcomposer_config_schema_form_base';
  }

  /**
   * Class constructor.
   */
  public function __construct($schema_base, $plugin_manager) {
    $this->schemaBase = $schema_base;
    $this->pluginManager = $plugin_manager;

    $this->processConfigObject();
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('webcomposer_config_schema.schema'),
      $container->get('plugin.manager.webcomposer_config_plugin')
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
   * Gets the schema object
   *
   * @return object
   */
  protected function schema() {
    return $this->schemaBase;
  }

  /**
   * Getters and Setters
   *
   */

  /**
   * Abstracted config method
   *
   * @return object
   */
  protected function get($name) {
    $editables = $this->getEditableConfigNames();
    $main = reset($editables);

    return $this->schemaBase->getConfigValue($main, $name);
  }

  /**
   * Abstracted config method
   *
   * @return object
   */
  protected function getAll() {
    $editables = $this->getEditableConfigNames();
    $main = reset($editables);

    return $this->schemaBase->getConfigValues($main);
  }

  /**
   * Abstracted save method
   *
   * @return object
   */
  protected function save($name, $value) {
    $editables = $this->getEditableConfigNames();
    $main = reset($editables);

    return $this->schemaBase->saveConfigValue($main, $name, $value);
  }
}
