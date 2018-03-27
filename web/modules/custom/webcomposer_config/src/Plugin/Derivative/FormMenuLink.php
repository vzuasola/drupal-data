<?php

namespace Drupal\webcomposer_config\Plugin\Derivative;

use Drupal\Component\Plugin\Derivative\DeriverBase;

class FormMenuLink extends DeriverBase {
  /**
   * {@inheritdoc}
   */
  public function getDerivativeDefinitions($base_plugin_definition) {
    if (!\Drupal::service('module_handler')->moduleExists('webcomposer_config_schema')) {
      $this->derivatives['webcomposer_config.admin_header_configuration'] = $base_plugin_definition;
      $this->derivatives['webcomposer_config.admin_header_configuration']['title'] = 'Header Configuration';
      $this->derivatives['webcomposer_config.admin_header_configuration']['parent'] = 'webcomposer_config.list';
      $this->derivatives['webcomposer_config.admin_header_configuration']['route_name'] = 'webcomposer_config.header_configuration_form';
      $this->derivatives['webcomposer_config.admin_header_configuration']['description'] = 'Provides configuration for Header Section.';

      $this->derivatives['webcomposer_config.admin_footer_configuration'] = $base_plugin_definition;
      $this->derivatives['webcomposer_config.admin_footer_configuration']['title'] = 'Footer Configuration';
      $this->derivatives['webcomposer_config.admin_footer_configuration']['parent'] = 'webcomposer_config.list';
      $this->derivatives['webcomposer_config.admin_footer_configuration']['route_name'] = 'webcomposer_config.footer_configuration_form';
      $this->derivatives['webcomposer_config.admin_footer_configuration']['description'] = 'Provides configuration for Footer Section.';

      $this->derivatives['webcomposer_config.admin_login_configuration'] = $base_plugin_definition;
      $this->derivatives['webcomposer_config.admin_login_configuration']['title'] = 'Login Configuration';
      $this->derivatives['webcomposer_config.admin_login_configuration']['parent'] = 'webcomposer_config.list';
      $this->derivatives['webcomposer_config.admin_login_configuration']['route_name'] = 'webcomposer_config.login_configuration_form';
      $this->derivatives['webcomposer_config.admin_login_configuration']['description'] = 'Provides configuration for Login Section.';

      $this->derivatives['webcomposer_config.admin_outdate_browser_configuration'] = $base_plugin_definition;
      $this->derivatives['webcomposer_config.admin_outdate_browser_configuration']['title'] = 'Outdated Browser Configuration';
      $this->derivatives['webcomposer_config.admin_outdate_browser_configuration']['parent'] = 'webcomposer_config.list';
      $this->derivatives['webcomposer_config.admin_outdate_browser_configuration']['route_name'] = 'webcomposer_config.outdated_browser_configuration_form';
      $this->derivatives['webcomposer_config.admin_outdate_browser_configuration']['description'] = 'Provides configuration for outdate browser messages.';

      $this->derivatives['webcomposer_config.admin_page_not_found_configuration'] = $base_plugin_definition;
      $this->derivatives['webcomposer_config.admin_page_not_found_configuration']['title'] = 'Page Not Found';
      $this->derivatives['webcomposer_config.admin_page_not_found_configuration']['parent'] = 'webcomposer_config.list';
      $this->derivatives['webcomposer_config.admin_page_not_found_configuration']['route_name'] = 'webcomposer_config.page_not_found_form';
      $this->derivatives['webcomposer_config.admin_page_not_found_configuration']['description'] = 'Provides configuration for page not found variables';

      $this->derivatives['webcomposer_config.admin_robots_configuration'] = $base_plugin_definition;
      $this->derivatives['webcomposer_config.admin_robots_configuration']['title'] = 'Robots Configuration';
      $this->derivatives['webcomposer_config.admin_robots_configuration']['parent'] = 'webcomposer_config.list';
      $this->derivatives['webcomposer_config.admin_robots_configuration']['route_name'] = 'webcomposer_config.robots_configuration_form';
      $this->derivatives['webcomposer_config.admin_robots_configuration']['description'] = 'Provides configuration for Robots.txt.';

      $this->derivatives['webcomposer_config.admin_pushnx_configuration'] = $base_plugin_definition;
      $this->derivatives['webcomposer_config.admin_pushnx_configuration']['title'] = 'Push Notification Configuration';
      $this->derivatives['webcomposer_config.admin_pushnx_configuration']['parent'] = 'webcomposer_config.list';
      $this->derivatives['webcomposer_config.admin_pushnx_configuration']['route_name'] = 'webcomposer_config.pushnx_configuration_form';
      $this->derivatives['webcomposer_config.admin_pushnx_configuration']['description'] = 'Provides configuration for Push Notification.';

      $this->derivatives['webcomposer_config.admin_log_configuration'] = $base_plugin_definition;
      $this->derivatives['webcomposer_config.admin_log_configuration']['title'] = 'Log Configuration';
      $this->derivatives['webcomposer_config.admin_log_configuration']['parent'] = 'webcomposer_config.list';
      $this->derivatives['webcomposer_config.admin_log_configuration']['route_name'] = 'webcomposer_config.log_configuration_form';
      $this->derivatives['webcomposer_config.admin_log_configuration']['description'] = 'Provides configuration for Logging.';

      $this->derivatives['webcomposer_config.admin_curacao_configuration'] = $base_plugin_definition;
      $this->derivatives['webcomposer_config.admin_curacao_configuration']['title'] = 'Curacao';
      $this->derivatives['webcomposer_config.admin_curacao_configuration']['parent'] = 'webcomposer_config.list';
      $this->derivatives['webcomposer_config.admin_curacao_configuration']['route_name'] = 'webcomposer_config.curacao_configuration_form';
      $this->derivatives['webcomposer_config.admin_curacao_configuration']['description'] = 'Configure Curacao';
    }

    return $this->derivatives;
  }
}
