<?php

namespace Drupal\webcomposer_form_manager\Entity;

/**
 * Defines a custom Webcomposer Form Entity
 */
class WebcomposerFormEntity {
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
  private $fields;

  /**
   * 
   */
  private $settings;

  /**
   * Constructor
   *
   * @param string $id The ID of the form
   * @param string $name The name of the form
   * @param array $settings An array of form settings, in form API format
   */
  public function __construct($id, $name, $settings = []) {
    $this->id = $id;
    $this->name = $name;
    $this->settings = $settings;
  }

  /**
   * 
   */
  public function setField(WebcomposerFormFieldEntity $field) {
    $field->setForm($this->getId());
    $this->fields[$field->getId()] = $field;
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
  public function getFields() {
    return $this->fields ? $this->fields : [];
  }

  /**
   * 
   */
  public function getField($id) {
    return isset($this->fields[$id]) ? $this->fields[$id] : NULL;
  }

  /**
   * 
   */
  public function getSettings() {
    return $this->settings ? $this->settings : [];
  }
}
