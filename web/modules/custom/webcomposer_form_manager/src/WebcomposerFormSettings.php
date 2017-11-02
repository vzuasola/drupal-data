<?php

namespace Drupal\webcomposer_form_manager;

use Drupal\Component\Utility\SortArray;
use Drupal\webcomposer_form_manager\Entity\WebcomposerFormEntity;
use Drupal\webcomposer_form_manager\Entity\WebcomposerFormFieldEntity;

/**
 * Returns Webcomposer form data as a parsed setting array
 */
class WebcomposerFormSettings {
  /**
   * Webcomposer Form Manager Instance.
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
  public function __construct($form_manager, $config_factory) {
    $this->formManager = $form_manager;
    $this->configFactory = $config_factory;
  }

  /**
   * Fetch a single form entity instance
   *
   * @param string $id The form ID
   *
   * @return array
   */
  public function getForm($id) {
    $config = $this->getFormDataFromConfig($id);
    $defaults = $this->getFormDataFromDefaults($id);

    $data = array_replace_recursive($defaults, $config);

    // sort the fields array depending on weights
    $weights = isset($data['weights']) ? $data['weights'] : [];
    if ($weights) {
      // sort the fields by weights fetched from the save storage
      uasort($data['fields'], function ($a, $b) use ($weights) {
        $aId = $a['id'];
        $bId = $b['id'];

        if (isset($weights[$aId]) && isset($weights[$bId])) {
          return SortArray::sortByKeyInt($weights[$aId], $weights[$bId], 'weight');
        }
      });
    }

    return $data;
  }

  /**
   * Get the data from the config using a form ID
   *
   * @param string $id The form ID
   *
   * @return array
   */
  private function getFormDataFromConfig($id) {
    try {
      $config = $this->configFactory->get("webcomposer_form_manager.form.$id");
      $data = $config->get();
    } catch (\Exception $e) {
      $data = ['error' => $this->t('Form not found')];
    }

    $formFields = $this->formManager->getFormById($id)->getFields();

    foreach ($formFields as $key => $value) {
      $defaultConfig = $this->configFactory->getEditable("webcomposer_form_manager.form.$id.$key");
      $config = $this->configFactory->get("webcomposer_form_manager.form.$id.$key");

      $data['fields'][$key] = array_replace_recursive($defaultConfig->get(), $config->get());
      $data['fields'][$key]['type'] = $value->getType();
    }

    return $data;
  }

  /**
   * Get the data from the default values using a form ID
   *
   * @param string $id The form ID
   *
   * @return array
   */
  private function getFormDataFromDefaults($id) {
    $data['form_settings'] = $this->getFormSettings($id);
    $data['fields'] = $this->getFields($id);

    return $data;
  }

  /**
   * Get form settings from form manager
   *
   * @param string $id The form ID
   *
   * @return array
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
   * Get form settings from form manager
   *
   * @param string $id The form ID
   *
   * @return array
   */
  private function getFields($id) {
    $data = [];
    $fields = $this->formManager->getFormById($id)->getFields();
    
    foreach ($fields as $key => $value) {
      $data[$key]['id'] = $value->getId();
      $data[$key]['type'] = $value->getType();
      $data[$key]['field_settings'] = $this->getFieldSettings($value);
    }

    return $data;
  }

  /**
   * Aggregate fields settings from a field instance
   * 
   * @param WebcomposerFormFieldEntity $field A field instance
   *
   * @return array
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
