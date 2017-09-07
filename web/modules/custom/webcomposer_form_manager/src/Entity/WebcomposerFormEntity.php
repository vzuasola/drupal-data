<?php

namespace Drupal\webcomposer_form_manager\Entity;

class WebcomposerFormEntity {
  /**
   * 
   */
  private $io;

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
  public function __construct($id, $name, $fields, $settings) {
    $this->id = $id;
    $this->name = $name;
    $this->fields = $fields;
    $this->settings = $settings;
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
  public function getSettings() {
    return $this->settings ? $this->settings : [];
  }
}
