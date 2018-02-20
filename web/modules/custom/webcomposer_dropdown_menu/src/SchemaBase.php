<?php

namespace Drupal\webcomposer_dropdown_menu;

use Drupal\Component\Utility\SortArray;

/**
 *
 */
class SchemaBase {
  private $configNames = [];

  /**
   *
   */
  public function __construct($config_typed, $language_manager, $config_factory) {
    $this->typedConfigManager = $config_typed;
    $this->languageManager = $language_manager;
    $this->configFactory = $config_factory;
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
  protected function getEditableConfigNames() {
    return $this->configNames;
  }

  /**
   * Retrieves a configuration object.
   */
  public function config($name) {
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
  public function getDefaultConfigValues($name, $key) {
    $config = $this->config($name);

    return $config->get($key);
  }

  /**
   * Get mutable config values
   */
  public function getConfigValuesAll($name) {
    if ($this->isConfigValueOverride()) {
      $language = $this->languageManager->getCurrentLanguage();
      $this->languageManager->setConfigOverrideLanguage($language);

      return $this->configFactory->get($name)->get();
    }

    $config = $this->config($name);

    return $config->get();
  }

  /**
   * Get mutable config values
   */
  public function getConfigValues($name, $key) {
    if ($this->isConfigValueOverride()) {
      $language = $this->languageManager->getCurrentLanguage();
      $this->languageManager->setConfigOverrideLanguage($language);

      $config = $this->configFactory->get($name)->get();

      return $config[$key];
    }

    $config = $this->config($name);

    return $config->get($key);
  }

  /**
   *
   */
  public function saveRawConfigValue($name, $key, $data) {
    if ($this->isConfigValueOverride()) {
      $language = $this->languageManager->getCurrentLanguage();
      $configTranslation = $this->languageManager->getLanguageConfigOverride($language->getId(), $name);

      $configTranslation->set($key, $data)->save();

      $savedConfig = $configTranslation->get();

      if (empty($savedConfig)) {
        $configTranslation->delete();
      } else {
        $configTranslation->save();
      }

      return;
    }

    $this->config($name)->set($key, $data)->save();
  }

  /**
   *
   */
  public function saveRawConfigValues($name, $keys, $data) {
    if ($this->isConfigValueOverride()) {
      $language = $this->languageManager->getCurrentLanguage();
      $configTranslation = $this->languageManager->getLanguageConfigOverride($language->getId(), $name);

      foreach ($keys as $key) {
        $configTranslation->set($key, $data[$key])->save();
      }

      $savedConfig = $configTranslation->get();

      if (empty($savedConfig)) {
        $configTranslation->delete();
      } else {
        $configTranslation->save();
      }

      return;
    }

    foreach ($keys as $key) {
      $this->config($name)->set($key, $data[$key])->save();
    }
  }

  /**
   *
   */
  public function isConfigValueOverride() {
    $currentLanguage = $this->languageManager->getCurrentLanguage()->getId();
    $defaultLanguage = $this->languageManager->getDefaultLanguage()->getId();

    return $defaultLanguage !== $currentLanguage;
  }
}
