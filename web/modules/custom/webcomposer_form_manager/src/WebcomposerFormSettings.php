<?php

namespace Drupal\webcomposer_form_manager;

use Drupal\webcomposer_form_manager\Entity\WebcomposerFormEntity;
use Drupal\webcomposer_form_manager\Entity\WebcomposerFormFieldEntity;

/**
 * Returns Webcomposer form data as a parsed setting array
 */
class WebcomposerFormSettings {
  /**
   * Webcomposer Instance.
   *
   * @var Drupal\webcomposer_form_manager\WebcomposerForm
   */
  protected $formManager;

  /**
   * Config Factory Object.
   *
   * @var core/lib/Drupal/Core/Config/ConfigFactory.php
   */
  protected $configFactory;

  /**
   * Public constructor
   */
  public function __construct($formManager, $configFactory) {
    $this->formManager = $formManager;
    $this->configFactory = $configFactory;
  }

  /**
   * Fetch a single form entity instance
   *
   * @param string $id The form ID
   * 
   * @return WebcomposerFormEntity
   */
  public function getForm($id) {
    $config = $this->getFormDataFromConfig($id);
    $defaults = $this->getFormDataFromDefaults($id);

    return array_replace_recursive($defaults, $config);
  }

  /**
   *
   */
  private function getFormDataFromConfig($id) {
    try {
      $config = $this->configFactory->get("webcomposer_form_manager.form.$id");
      $data = $config->get();
    } catch (\Exception $e) {
      $data = ['error' => $this->t('Form not found')];
    }

    // @todo Form fields should be sorted based on weights at this point, so
    // that FE won't need to sort it
    $formFields = $this->formManager->getFormById($id)->getFields();

    foreach ($formFields as $key => $value) {
      $config = $this->configFactory->get("webcomposer_form_manager.form.$id.$key");
      $data['fields'][$key] = $config->get();
      $data['fields'][$key]['type'] = $value->getType();
    }

    return $data;
  }

  /**
   *
   */
  private function getFormDataFromDefaults($id) {
    $data['form_settings'] = $this->getFormSettings($id);
    $data['fields'] = $this->getFields($id);

    return $data;
  }

  /**
   *
   */
  private function getFormSettings($id) {
    $data = [];
    $settings = $this->formManager->getFormById($id)->getSettings();

    foreach ($settings as $key => $value) {
      if (!empty($value['#default_value'])) {
        $data[$key] = $value['#default_value'];
      }
    }

    return $data;
  }

  /**
   *
   */
  private function getFields($id) {
    $data = [];
    $fields = $this->formManager->getFormById($id)->getFields();
    
    foreach ($fields as $key => $value) {
      $data[$key]['type'] = $value->getType();
      $data[$key]['field_settings'] = $this->getFieldSettings($value);
    }

    return $data;
  }

  /**
   *
   */
  private function getFieldSettings(WebcomposerFormFieldEntity $field) {
    $data = [];
    $settings = $field->getSettings();

    foreach ($settings as $key => $value) {
      if (!empty($value['#default_value'])) {
        $data[$key] = $value['#default_value'];
      }
    }

    return $data;
  }
}
