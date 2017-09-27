<?php

namespace Drupal\webcomposer_form_manager;

use Drupal\Component\Plugin\PluginInspectionInterface;

/**
 * Defines an interface for Form manager plugins.
 */
interface WebcomposerFormInterface extends PluginInspectionInterface {

public function getFormId();

public function getFormName();

}
