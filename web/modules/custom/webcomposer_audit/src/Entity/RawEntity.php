<?php

namespace Drupal\webcomposer_audit\Entity;


use Drupal\Core\Entity\Entity;
use Drupal\Core\TypedData\MapDataDefinition;
use Drupal\Core\TypedData\Plugin\DataType\Any;

/**
 *
 */
class RawEntity extends Entity {
  private $id;
  private $name;
  private $before;

  /**
   *
   */
  public function __construct($name, array $values) {
    $this->id = $name;
    $this->name = $name;

    parent::__construct($this->createData($values), 'config');
  }

  /**
   *
   */
  public function __sleep() {
    $vars = get_object_vars($this);
    return array_keys($vars);
  }

  /**
   *
   */
  public function __wakeup() {
  }

  /**
   *
   */
  private function createData($values) {
    $data = [];

    foreach ($values as $key => $value) {
      $type = MapDataDefinition::create();
      $item = Any::createInstance($type, $key);
      $item->setValue($value);

      $data[$key] = $item;
    }

    return $data;
  }

  /**
   *
   */
  public function label() {
    return $this->name;
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
  public function getOriginal() {
    return $this->before;
  }

  /**
   *
   */
  public function setOriginal($before) {
    $this->before = $before;
  }
}
