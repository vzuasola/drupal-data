<?php

namespace Drupal\webcomposer_config\Plugin\Derivative;

use Drupal\Component\Plugin\Derivative\DeriverBase;

class ConfigFormLocalTasks extends DeriverBase {
  /**
   * {@inheritdoc}
   */
  public function getDerivativeDefinitions($base_plugin_definition) {
    if (!\Drupal::service('module_handler')->moduleExists('webcomposer_config_schema')) {
      $this->derivatives['webcomposer_config.footer_configuration_tab'] = $base_plugin_definition;
      $this->derivatives['webcomposer_config.footer_configuration_tab']['title'] = 'Footer Configuration';
      $this->derivatives['webcomposer_config.footer_configuration_tab']['route_name'] = 'webcomposer_config.footer_configuration_form';
      $this->derivatives['webcomposer_config.footer_configuration_tab']['base_route'] = 'webcomposer_config.footer_configuration_form';

      $this->derivatives['webcomposer_config.header_configuration_tab'] = $base_plugin_definition;
      $this->derivatives['webcomposer_config.header_configuration_tab']['title'] = 'Header Configuration';
      $this->derivatives['webcomposer_config.header_configuration_tab']['route_name'] = 'webcomposer_config.header_configuration_form';
      $this->derivatives['webcomposer_config.header_configuration_tab']['base_route'] = 'webcomposer_config.header_configuration_form';

      $this->derivatives['webcomposer_config.login_configuration_tab'] = $base_plugin_definition;
      $this->derivatives['webcomposer_config.login_configuration_tab']['title'] = 'Login Configuration';
      $this->derivatives['webcomposer_config.login_configuration_tab']['route_name'] = 'webcomposer_config.login_configuration_form';
      $this->derivatives['webcomposer_config.login_configuration_tab']['base_route'] = 'webcomposer_config.login_configuration_form';

      $this->derivatives['webcomposer_config.outdated_browser_configuration_tab'] = $base_plugin_definition;
      $this->derivatives['webcomposer_config.outdated_browser_configuration_tab']['title'] = 'Outdated Browser Configuration';
      $this->derivatives['webcomposer_config.outdated_browser_configuration_tab']['route_name'] = 'webcomposer_config.outdated_browser_configuration_form';
      $this->derivatives['webcomposer_config.outdated_browser_configuration_tab']['base_route'] = 'webcomposer_config.outdated_browser_configuration_form';

      $this->derivatives['webcomposer_config.page_not_found_configuration_tab'] = $base_plugin_definition;
      $this->derivatives['webcomposer_config.page_not_found_configuration_tab']['title'] = 'Page Not Found Configuration';
      $this->derivatives['webcomposer_config.page_not_found_configuration_tab']['route_name'] = 'webcomposer_config.page_not_found_form';
      $this->derivatives['webcomposer_config.page_not_found_configuration_tab']['base_route'] = 'webcomposer_config.page_not_found_form';

      $this->derivatives['webcomposer_config.pushnx_configuration_tab'] = $base_plugin_definition;
      $this->derivatives['webcomposer_config.pushnx_configuration_tab']['title'] = 'Push Notification Configuration';
      $this->derivatives['webcomposer_config.pushnx_configuration_tab']['route_name'] = 'webcomposer_config.pushnx_configuration_form';
      $this->derivatives['webcomposer_config.pushnx_configuration_tab']['base_route'] = 'webcomposer_config.pushnx_configuration_form';

      $this->derivatives['webcomposer_config.robots_configuration_tab'] = $base_plugin_definition;
      $this->derivatives['webcomposer_config.robots_configuration_tab']['title'] = 'Robots Configuration';
      $this->derivatives['webcomposer_config.robots_configuration_tab']['route_name'] = 'webcomposer_config.robots_configuration_form';
      $this->derivatives['webcomposer_config.robots_configuration_tab']['base_route'] = 'webcomposer_config.robots_configuration_form';

      $this->derivatives['webcomposer_config.log_configuration_tab'] = $base_plugin_definition;
      $this->derivatives['webcomposer_config.log_configuration_tab']['title'] = 'Log Configuration';
      $this->derivatives['webcomposer_config.log_configuration_tab']['route_name'] = 'webcomposer_config.log_configuration_form';
      $this->derivatives['webcomposer_config.log_configuration_tab']['base_route'] = 'webcomposer_config.log_configuration_form';
    }

    return $this->derivatives;
  }
}
