<?php

namespace Drupal\webcomposer_config\Plugin\Derivative;

use Drupal\Component\Plugin\Derivative\DeriverBase;

class ConfigTranslation extends DeriverBase {
  /**
   * {@inheritdoc}
   */
  public function getDerivativeDefinitions($base_plugin_definition) {
    if (!\Drupal::service('module_handler')->moduleExists('webcomposer_config_schema')) {
      $name = 'webcomposer_config.header_configuration_schema';
      $this->derivatives[$name] = $base_plugin_definition;
      $this->derivatives[$name]['title'] = 'Header Configuration';
      $this->derivatives[$name]['base_route_name'] = 'webcomposer_config.header_configuration_form';
      $this->derivatives[$name]['names'][] = 'webcomposer_config.header_configuration';

      $name = 'webcomposer_config.footer_configuration_schema';
      $this->derivatives[$name] = $base_plugin_definition;
      $this->derivatives[$name]['title'] = 'Footer Configuration';
      $this->derivatives[$name]['base_route_name'] = 'webcomposer_config.footer_configuration_form';
      $this->derivatives[$name]['names'][] = 'webcomposer_config.footer_configuration';

      $name = 'webcomposer_config.login_configuration_schema';
      $this->derivatives[$name] = $base_plugin_definition;
      $this->derivatives[$name]['title'] = 'Login Configuration';
      $this->derivatives[$name]['base_route_name'] = 'webcomposer_config.login_configuration_form';
      $this->derivatives[$name]['names'][] = 'webcomposer_config.login_configuration';

      $name = 'webcomposer_config.outdated_browser_configuration_schema';
      $this->derivatives[$name] = $base_plugin_definition;
      $this->derivatives[$name]['title'] = 'Outdated Browser Configuration';
      $this->derivatives[$name]['base_route_name'] = 'webcomposer_config.outdated_browser_configuration_form';
      $this->derivatives[$name]['names'][] = 'webcomposer_config.browser_configuration';

      $name = 'webcomposer_config.page_not_found_schema';
      $this->derivatives[$name] = $base_plugin_definition;
      $this->derivatives[$name]['title'] = 'Page Not Found Configuration';
      $this->derivatives[$name]['base_route_name'] = 'webcomposer_config.page_not_found_form';
      $this->derivatives[$name]['names'][] = 'webcomposer_config.page_not_found';
    }

    return $this->derivatives;
  }
}
