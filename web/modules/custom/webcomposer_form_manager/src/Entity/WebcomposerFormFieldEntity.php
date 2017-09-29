<?php

namespace Drupal\webcomposer_form_manager\Entity;

/**
 * Defines a custom Webcomposer Form Field Entity
 */
class WebcomposerFormFieldEntity {
  /**
   * 
   */
  private $id;

  /**
   *
   */
  private $name;

  /**
   *
   */
  private $type;

  /**
   *
   */
  private $options;

  /**
   * 
   */
  private $settings;

  /**
   * 
   */
  private $form;

  /**
   * Constructor
   *
   * @param string $id The ID of this field
   * @param string $name The friendly name of this field
   * @param string $type The field type
   * @param array $options List of options that alters this field's behavior
   * @param array $settings An array of field settings, in form API format
   */
  public function __construct($id, $name, $type, $options = [], $settings = []) {
    $this->id = $id;
    $this->name = $name;
    $this->type = $type;
    $this->options = $options;
    $this->settings = $settings;
  }

  /**
   * Set the parent form ID of this field
   */
  public function setForm($form) {
    $this->form = $form;
  }

  /**
   * 
   */
  public function getId() {
    return $this->id;
  }

  /**
   * 
   */
  public function getName() {
    return $this->name;
  }

  /**
   * 
   */
  public function getType() {
    return $this->type;
  }

  /**
   * 
   */
  public function getOption($id) {
    return isset($this->options[$id]) ? $this->options[$id] : NULL;
  }

  /**
   * 
   */
  public function getOptions() {
    return $this->options;
  }

  /**
   * 
   */
  public function getSettings() {
    return $this->settings ? $this->settings : [];
  }
}
