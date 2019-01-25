<?php

namespace Drupal\webcomposer_config_schema\Form;
use Drupal\Core\Datetime\DrupalDateTime;

trait SchemaTrait {
  /**
   * Gets the schema object
   *
   * @return object
   */
  protected function schema() {
    return $this->schemaBase;
  }

  /**
   *
   */
  protected function isTranslated() {
    return $this->schemaBase->isConfigValueOverride();
  }

  /**
   * Abstracted config method
   *
   * @return object
   */
  protected function get($name, $options = []) {

    $editables = $this->getEditableConfigNames();
    $main = reset($editables);
    $value = $this->schemaBase->getConfigValue($main, $name);
    if (isset($options['time_format'])) {
      $value = $this->createTimestampObject($value, $options['time_format']);
    }

    return $value;
  }

  /**
   * setting and converting utc to locale timezone if set
   * referenced from https://www.drupal.org/node/1834108
   */
  private function createTimestampObject($date, $time_format) {
    if (isset($date)) {
      $date = new DrupalDateTime(date($time_format, $date));
      return $date->setTimezone(new \DateTimeZone(drupal_get_user_timezone()));
    }
  }

  /**
   * Abstracted config method
   *
   * @return object
   */
  protected function getAll() {
    $editables = $this->getEditableConfigNames();
    $main = reset($editables);

    return $this->schemaBase->getConfigValues($main);
  }

  /**
   * Abstracted save method
   *
   * @return object
   */
  protected function save(array $data) {
    // remove NULL values from data since it will be persisted
    if ($this->isTranslated()) {
      $data = array_filter($data, function ($value) {
        return isset($value);
      });
    }

    $editables = $this->getEditableConfigNames();
    $main = reset($editables);

    return $this->schemaBase->saveConfigValues($main, $data);
  }
}
