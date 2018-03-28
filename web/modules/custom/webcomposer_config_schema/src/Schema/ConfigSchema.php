<?php

namespace Drupal\webcomposer_config_schema\Schema;

class ConfigSchema {
  private $configNames = [];

  /**
   *
   */
  public function __construct($config_typed, $language_manager, $config_factory, $module_handler) {
    $this->typedConfigManager = $config_typed;
    $this->languageManager = $language_manager;
    $this->configFactory = $config_factory;
    $this->moduleHandler = $module_handler;
  }

  /**
   *
   */
  public function getEditableConfigNames() {
    return $this->configNames;
  }

  /**
   *
   */
  public function setEditableConfigNames($config_names) {
    $this->configNames = $config_names;

    return $this;
  }

  /**
   *
   */
  public function isConfigValueOverride() {
    $currentLanguage = $this->languageManager->getCurrentLanguage()->getId();
    $defaultLanguage = $this->languageManager->getDefaultLanguage()->getId();

    return $defaultLanguage !== $currentLanguage;
  }

  /**
   * Retrieves a configuration object.
   */
  public function getEditable($name) {
    $config_factory = $this->configFactory;

    if (in_array($name, $this->getEditableConfigNames())) {
      $config = $config_factory->getEditable($name);
    } else {
      $config = $config_factory->get($name);
    }

    return $config;
  }

  /**
   * Get default config values
   */
  public function getDefaultConfigValues($name) {
    $config = $this->getEditable($name);

    return $config->get();
  }

  /**
   * Getter methods
   *
   */

  /**
   * Get mutable config values
   */
  public function getConfigValues($name) {
    if ($this->isConfigValueOverride()) {
      $language = $this->languageManager->getCurrentLanguage();
      $this->languageManager->setConfigOverrideLanguage($language);

      return $this->configFactory->get($name)->get();
    }

    $config = $this->getEditable($name);

    return $config->get();
  }

  /**
   * Get mutable config values
   */
  public function getConfigValue($name, $key) {
    if ($this->isConfigValueOverride()) {
      $language = $this->languageManager->getCurrentLanguage();
      $this->languageManager->setConfigOverrideLanguage($language);

      $config = $this->configFactory->get($name)->get();

      return $config[$key];
    }

    $config = $this->getEditable($name);

    return $config->get($key);
  }

  /**
   * Translated Getter methods
   *
   */

  /**
   * Get mutable config values
   */
  public function getConfigValuesByLanguage($name, $id) {
    $default = $this->languageManager->getDefaultLanguage();
    $language = $this->languageManager->getLanguage($id);

    $base_config = $this->getDefaultConfigValues($name);

    if ($default->getId() === $language->getId()) {
      return $base_config;
    }

    $this->languageManager->setConfigOverrideLanguage($language);

    $config = $this->configFactory->get($name)->get();

    return $this->arrayDiff($config, $base_config);
  }

  /**
   * Array diff
   */
  private function arrayDiff($new, $old) {
    $result = [];

    foreach ($new as $key => $value) {
      if (!is_array($old) || !array_key_exists($key, $old)) {
        $result[$key] = $value;
        continue;
      }
      if (is_array($value)) {
        $recursiveArrayDiff = $this->arrayDiff($value, $old[$key]);
        if (count($recursiveArrayDiff)) {
          $result[$key] = $recursiveArrayDiff;
        }
        continue;
      }
      if ($value != $old[$key]) {
        $result[$key] = $value;
      }
    }

    return $result;
  }

  /**
   * Setter methods
   *
   */

  /**
   *
   */
  public function saveConfigValues($name, $data) {
    if ($this->isConfigValueOverride()) {
      $this->doConfigTranslate($name, $data);
    } else {
      $this->doConfigSave($name, $data);
    }
  }

  /**
   *
   */
  private function doConfigSave($name, $data) {
    $configEditable = $this->getEditable($name);
    $before = $configEditable->get();

    foreach ($data as $key => $value) {
      $configEditable->set($key, $data[$key]);
    }

    if (empty($before)) {
      $this->moduleHandler->invokeAll('webcomposer_config_schema_insert', [$name, $data]);
    } else {
      $this->moduleHandler->invokeAll('webcomposer_config_schema_update', [$name, $data, $before]);
    }

    $configEditable->save();
  }

  /**
   *
   */
  private function doConfigTranslate($name, $data) {
    $language = $this->languageManager->getCurrentLanguage();

    $configTranslation = $this->languageManager->getLanguageConfigOverride($language->getId(), $name);
    $before = $configTranslation->get();

    // if the translation is empty, use the config editable of EN
    if (empty($before)) {
      $configEditable = $this->getEditable($name);
      $before = $configEditable->get();
    }

    foreach ($data as $key => $value) {
      $configTranslation->set($key, $data[$key]);
    }

    $configTranslation->save();

    $savedConfig = $configTranslation->get();

    if (empty($savedConfig)) {
      $configTranslation->delete();
    } else {
      $configTranslation->save();
    }

    $this->moduleHandler->invokeAll('webcomposer_config_schema_translate', [$name, $data, $before]);
  }

  /**
   * Delete methods
   *
   */

  /**
   * Delete mutable config values
   */
  public function deleteConfigValues($name) {
    $default = $this->languageManager->getDefaultLanguage();
    $language = $this->languageManager->getCurrentLanguage();

    $base_config = $this->getConfigValues($name);

    if ($default->getId() === $language->getId()) {
      return;
    }

    $this->languageManager
      ->getLanguageConfigOverride($language->getId(), $name)
      ->delete();

    return TRUE;
  }
}
