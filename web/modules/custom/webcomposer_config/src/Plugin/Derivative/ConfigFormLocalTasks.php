<?php

namespace Drupal\webcomposer_config\Plugin\Derivative;

use Drupal\Component\Plugin\Derivative\DeriverBase;

class ConfigFormLocalTasks extends DeriverBase {
  /**
   * {@inheritdoc}
   */
  public function getDerivativeDefinitions($base_plugin_definition) {
    if (!\Drupal::service('module_handler')->moduleExists('webcomposer_config_schema')) {
      $name = 'webcomposer_config.footer_configuration_tab';
      $this->derivatives[$name] = $base_plugin_definition;
      $this->derivatives[$name]['title'] = 'Footer Configuration';
      $this->derivatives[$name]['route_name'] = 'webcomposer_config.footer_configuration_form';
      $this->derivatives[$name]['base_route'] = 'webcomposer_config.footer_configuration_form';

      $name = 'webcomposer_config.header_configuration_tab';
      $this->derivatives[$name] = $base_plugin_definition;
      $this->derivatives[$name]['title'] = 'Header Configuration';
      $this->derivatives[$name]['route_name'] = 'webcomposer_config.header_configuration_form';
      $this->derivatives[$name]['base_route'] = 'webcomposer_config.header_configuration_form';

      $name = 'webcomposer_config.login_configuration_tab';
      $this->derivatives[$name] = $base_plugin_definition;
      $this->derivatives[$name]['title'] = 'Login Configuration';
      $this->derivatives[$name]['route_name'] = 'webcomposer_config.login_configuration_form';
      $this->derivatives[$name]['base_route'] = 'webcomposer_config.login_configuration_form';

      $name = 'webcomposer_config.outdated_browser_configuration_tab';
      $this->derivatives[$name] = $base_plugin_definition;
      $this->derivatives[$name]['title'] = 'Outdated Browser Configuration';
      $this->derivatives[$name]['route_name'] = 'webcomposer_config.outdated_browser_configuration_form';
      $this->derivatives[$name]['base_route'] = 'webcomposer_config.outdated_browser_configuration_form';

      $name = 'webcomposer_config.page_not_found_configuration_tab';
      $this->derivatives[$name] = $base_plugin_definition;
      $this->derivatives[$name]['title'] = 'Page Not Found Configuration';
      $this->derivatives[$name]['route_name'] = 'webcomposer_config.page_not_found_form';
      $this->derivatives[$name]['base_route'] = 'webcomposer_config.page_not_found_form';

      $name = 'webcomposer_config.pushnx_configuration_tab';
      $this->derivatives[$name] = $base_plugin_definition;
      $this->derivatives[$name]['title'] = 'Push Notification Configuration';
      $this->derivatives[$name]['route_name'] = 'webcomposer_config.pushnx_configuration_form';
      $this->derivatives[$name]['base_route'] = 'webcomposer_config.pushnx_configuration_form';

      $name = 'webcomposer_config.robots_configuration_tab';
      $this->derivatives[$name] = $base_plugin_definition;
      $this->derivatives[$name]['title'] = 'Robots Configuration';
      $this->derivatives[$name]['route_name'] = 'webcomposer_config.robots_configuration_form';
      $this->derivatives[$name]['base_route'] = 'webcomposer_config.robots_configuration_form';

      $name = 'webcomposer_config.log_configuration_tab';
      $this->derivatives[$name] = $base_plugin_definition;
      $this->derivatives[$name]['title'] = 'Log Configuration';
      $this->derivatives[$name]['route_name'] = 'webcomposer_config.log_configuration_form';
      $this->derivatives[$name]['base_route'] = 'webcomposer_config.log_configuration_form';
    }

    return $this->derivatives;
  }
}
