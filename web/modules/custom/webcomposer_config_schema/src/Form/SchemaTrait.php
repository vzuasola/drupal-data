<?php

namespace Drupal\webcomposer_config_schema\Form;

trait SchemaTrait {
  /**
   * Gets the schema object
   *
   * @return object
   */
  protected function schema() {
    return $this->schemaBase;
  }

  /**
   *
   */
  protected function isTranslated() {
    return $this->schemaBase->isConfigValueOverride();
  }

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
  protected function save(array $data) {
    // remove NULL values from data since it will be persisted
    if ($this->isTranslated()) {
      $data = array_filter($data, function ($value) {
        return isset($value);
      });
    }

    $editables = $this->getEditableConfigNames();
    $main = reset($editables);

    return $this->schemaBase->saveConfigValues($main, $data);
  }
}
