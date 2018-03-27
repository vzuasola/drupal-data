<?php

namespace Drupal\webcomposer_config\Plugin\Derivative;

use Drupal\Component\Plugin\Derivative\DeriverBase;

class ConfigTranslation extends DeriverBase {
  /**
   * {@inheritdoc}
   */
  public function getDerivativeDefinitions($base_plugin_definition) {
    if (!\Drupal::service('module_handler')->moduleExists('webcomposer_config_schema')) {
      $this->derivatives['webcomposer_config.header_configuration_schema'] = $base_plugin_definition;
      $this->derivatives['webcomposer_config.header_configuration_schema']['title'] = 'Header Configuration';
      $this->derivatives['webcomposer_config.header_configuration_schema']['base_route_name'] = 'webcomposer_config.header_configuration_form';
      $this->derivatives['webcomposer_config.header_configuration_schema']['names'][] = 'webcomposer_config.header_configuration';

      $this->derivatives['webcomposer_config.footer_configuration_schema'] = $base_plugin_definition;
      $this->derivatives['webcomposer_config.footer_configuration_schema']['title'] = 'Footer Configuration';
      $this->derivatives['webcomposer_config.footer_configuration_schema']['base_route_name'] = 'webcomposer_config.footer_configuration_form';
      $this->derivatives['webcomposer_config.footer_configuration_schema']['names'][] = 'webcomposer_config.footer_configuration';

      $this->derivatives['webcomposer_config.login_configuration_schema'] = $base_plugin_definition;
      $this->derivatives['webcomposer_config.login_configuration_schema']['title'] = 'Login Configuration';
      $this->derivatives['webcomposer_config.login_configuration_schema']['base_route_name'] = 'webcomposer_config.login_configuration_form';
      $this->derivatives['webcomposer_config.login_configuration_schema']['names'][] = 'webcomposer_config.login_configuration';

      $this->derivatives['webcomposer_config.outdated_browser_configuration_schema'] = $base_plugin_definition;
      $this->derivatives['webcomposer_config.outdated_browser_configuration_schema']['title'] = 'Outdated Browser Configuration';
      $this->derivatives['webcomposer_config.outdated_browser_configuration_schema']['base_route_name'] = 'webcomposer_config.outdated_browser_configuration_form';
      $this->derivatives['webcomposer_config.outdated_browser_configuration_schema']['names'][] = 'webcomposer_config.browser_configuration';
    
      $this->derivatives['webcomposer_config.page_not_found_schema'] = $base_plugin_definition;
      $this->derivatives['webcomposer_config.page_not_found_schema']['title'] = 'Page Not Found Configuration';
      $this->derivatives['webcomposer_config.page_not_found_schema']['base_route_name'] = 'webcomposer_config.page_not_found_form';
      $this->derivatives['webcomposer_config.page_not_found_schema']['names'][] = 'webcomposer_config.page_not_found';
    }

    return $this->derivatives;
  }
}
