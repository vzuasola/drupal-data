<?php

namespace Drupal\webcomposer_form_manager;

use Drupal\Component\Plugin\PluginInspectionInterface;

/**
 * Defines an interface for the Webcomposer Form plugin
 */
interface WebcomposerFormInterface extends PluginInspectionInterface {
  /**
   * Return an array of form settings
   *
   * @return array
   */
  public function getSettings();

  /**
   * Return an array of fields
   *
   * @return array
   */
  public function getFields();
}
