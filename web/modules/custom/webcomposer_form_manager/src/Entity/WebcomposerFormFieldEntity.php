<?php

namespace Drupal\webcomposer_form_manager\Entity;

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
   * 
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
