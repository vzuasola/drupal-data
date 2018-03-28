<?php

namespace Drupal\webcomposer_config\Plugin\Derivative;

use Drupal\Component\Plugin\Derivative\DeriverBase;

class FormMenuLink extends DeriverBase {
  /**
   * {@inheritdoc}
   */
  public function getDerivativeDefinitions($base_plugin_definition) {
    if (!\Drupal::service('module_handler')->moduleExists('webcomposer_config_schema')) {
      $name = 'webcomposer_config.admin_header_configuration';
      $this->derivatives[$name] = $base_plugin_definition;
      $this->derivatives[$name]['title'] = 'Header Configuration';
      $this->derivatives[$name]['parent'] = 'webcomposer_config.list';
      $this->derivatives[$name]['route_name'] = 'webcomposer_config.header_configuration_form';
      $this->derivatives[$name]['description'] = 'Provides configuration for Header Section.';

      $name = 'webcomposer_config.admin_footer_configuration';
      $this->derivatives[$name] = $base_plugin_definition;
      $this->derivatives[$name]['title'] = 'Footer Configuration';
      $this->derivatives[$name]['parent'] = 'webcomposer_config.list';
      $this->derivatives[$name]['route_name'] = 'webcomposer_config.footer_configuration_form';
      $this->derivatives[$name]['description'] = 'Provides configuration for Footer Section.';

      $name = 'webcomposer_config.admin_login_configuration';
      $this->derivatives[$name] = $base_plugin_definition;
      $this->derivatives[$name]['title'] = 'Login Configuration';
      $this->derivatives[$name]['parent'] = 'webcomposer_config.list';
      $this->derivatives[$name]['route_name'] = 'webcomposer_config.login_configuration_form';
      $this->derivatives[$name]['description'] = 'Provides configuration for Login Section.';

      $name = 'webcomposer_config.admin_outdate_browser_configuration';
      $this->derivatives[$name] = $base_plugin_definition;
      $this->derivatives[$name]['title'] = 'Outdated Browser Configuration';
      $this->derivatives[$name]['parent'] = 'webcomposer_config.list';
      $this->derivatives[$name]['route_name'] = 'webcomposer_config.outdated_browser_configuration_form';
      $this->derivatives[$name]['description'] = 'Provides configuration for outdate browser messages.';

      $name = 'webcomposer_config.admin_page_not_found_configuration';
      $this->derivatives[$name] = $base_plugin_definition;
      $this->derivatives[$name]['title'] = 'Page Not Found';
      $this->derivatives[$name]['parent'] = 'webcomposer_config.list';
      $this->derivatives[$name]['route_name'] = 'webcomposer_config.page_not_found_form';
      $this->derivatives[$name]['description'] = 'Provides configuration for page not found variables';

      $name = 'webcomposer_config.admin_robots_configuration';
      $this->derivatives[$name] = $base_plugin_definition;
      $this->derivatives[$name]['title'] = 'Robots Configuration';
      $this->derivatives[$name]['parent'] = 'webcomposer_config.list';
      $this->derivatives[$name]['route_name'] = 'webcomposer_config.robots_configuration_form';
      $this->derivatives[$name]['description'] = 'Provides configuration for Robots.txt.';

      $name = 'webcomposer_config.admin_pushnx_configuration';
      $this->derivatives[$name] = $base_plugin_definition;
      $this->derivatives[$name]['title'] = 'Push Notification Configuration';
      $this->derivatives[$name]['parent'] = 'webcomposer_config.list';
      $this->derivatives[$name]['route_name'] = 'webcomposer_config.pushnx_configuration_form';
      $this->derivatives[$name]['description'] = 'Provides configuration for Push Notification.';

      $name = 'webcomposer_config.admin_log_configuration';
      $this->derivatives[$name] = $base_plugin_definition;
      $this->derivatives[$name]['title'] = 'Log Configuration';
      $this->derivatives[$name]['parent'] = 'webcomposer_config.list';
      $this->derivatives[$name]['route_name'] = 'webcomposer_config.log_configuration_form';
      $this->derivatives[$name]['description'] = 'Provides configuration for Logging.';

      $name = 'webcomposer_config.admin_curacao_configuration';
      $this->derivatives[$name] = $base_plugin_definition;
      $this->derivatives[$name]['title'] = 'Curacao';
      $this->derivatives[$name]['parent'] = 'webcomposer_config.list';
      $this->derivatives[$name]['route_name'] = 'webcomposer_config.curacao_configuration_form';
      $this->derivatives[$name]['description'] = 'Configure Curacao';
    }

    return $this->derivatives;
  }
}
