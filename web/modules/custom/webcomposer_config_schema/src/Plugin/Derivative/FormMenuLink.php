<?php

namespace Drupal\webcomposer_config_schema\Plugin\Derivative;

use Drupal\Component\Plugin\Derivative\DeriverBase;

/**
 *
 */
class FormMenuLink extends DeriverBase {
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
      if (isset($definition['menu'])) {
        $name = "webcomposer_config_schema.admin_form_{$id}_menu";

        $this->derivatives[$name] = $base_plugin_definition;
        $this->derivatives[$name]['title'] = $definition['menu']['title'];
        $this->derivatives[$name]['parent'] = $definition['menu']['parent'];
        $this->derivatives[$name]['description'] = $definition['menu']['description'];

        if (isset($definition['menu']['weight'])) {
          $this->derivatives[$name]['weight'] = $definition['menu']['weight'];;
        }

        $this->derivatives[$name]['route_name'] = "webcomposer_config_schema.form_{$id}";
      }
    }

    return $this->derivatives;
  }
}
