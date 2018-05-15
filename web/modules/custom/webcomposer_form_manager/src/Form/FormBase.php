<?php

namespace Drupal\webcomposer_form_manager\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Form Base
 *
 * @package Drupal\webcomposer_form_manager\Form
 */
class FormBase extends ConfigFormBase {
  protected $typedConfigManager;
  protected $languageManager;
  protected $moduleHandler;

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'base';
  }

  /**
   * Class constructor.
   */
  public function __construct($typedConfigManager, $languageManager, $module_handler) {
    $this->typedConfigManager = $typedConfigManager;
    $this->languageManager = $languageManager;
    $this->moduleHandler = $module_handler;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('config.typed'),
      $container->get('language_manager')
    );
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
  public function getConfigValues($name, $key) {
    if ($this->isConfigValueOverride()) {
      $language = $this->languageManager->getCurrentLanguage();
      $this->languageManager->setConfigOverrideLanguage($language);

      $config = $this->configFactory()->get($name)->get();

      return $config[$key];
    }

    $config = $this->config($name);

    return $config->get($key);
  }

  /**
   *
   */
  public function saveConfigValues($name, $keys, FormStateInterface $formState) {
    if ($this->isConfigValueOverride()) {
      $language = $this->languageManager->getCurrentLanguage();
      $configTranslation = $this->languageManager->getLanguageConfigOverride($language->getId(), $name);

      foreach ($keys as $key) {
        $configTranslation->set($key, $formState->getValue($key))->save();
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
      $this->config($name)->set($key, $formState->getValue($key))->save();
    }
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
  protected function isConfigValueOverride() {
    $currentLanguage = $this->languageManager->getCurrentLanguage()->getId();
    $defaultLanguage = $this->languageManager->getDefaultLanguage()->getId();

    return $defaultLanguage !== $currentLanguage;
  }
}
