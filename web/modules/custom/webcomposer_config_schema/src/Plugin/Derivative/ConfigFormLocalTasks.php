<?php

namespace Drupal\webcomposer_config_schema\Plugin\Derivative;

use Drupal\Component\Plugin\Derivative\DeriverBase;

class ConfigFormLocalTasks extends DeriverBase {
  /**
   * 
   */
  public function __construct() {
    $this->pluginManager = \Drupal::service('plugin.manager.webcomposer_config_plugin');
  }

  /**
   * {@inheritdoc}
   */
  public function getDerivativeDefinitions($base_plugin_definition) {
    $definitions = $this->pluginManager->getDefinitions();

    foreach ($definitions as $id => $definition) {
      if (isset($definition['route'])) {
        $name = "webcomposer_config_schema.form_{$id}_tab";

        $this->derivatives[$name] = $base_plugin_definition;
        $this->derivatives[$name]['title'] = 'Form';
        $this->derivatives[$name]['route_name'] = "webcomposer_config_schema.form_{$id}";
        $this->derivatives[$name]['base_route'] = "webcomposer_config_schema.form_{$id}";

        $name = "webcomposer_config_schema.form_{$id}_translate_tab";

        $this->derivatives[$name] = $base_plugin_definition;
        $this->derivatives[$name]['title'] = 'Translate';
        $this->derivatives[$name]['route_name'] = "webcomposer_config_schema.form_translate";
        $this->derivatives[$name]['base_route'] = "webcomposer_config_schema.form_{$id}";
        $this->derivatives[$name]['route_parameters'] = [
          'form' => $id,
        ];
      }
    }

    return $this->derivatives;
  }
}
