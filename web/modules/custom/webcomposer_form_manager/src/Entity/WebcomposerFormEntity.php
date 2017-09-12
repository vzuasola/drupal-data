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
   * 
   */
  public function __construct($id, $name, $settings) {
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
