<?php

namespace Drupal\registration_theme\Entity;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Provides an interface for defining Registration Theme entities.
 */
interface RegistrationThemeEntityInterface extends ConfigEntityInterface {

	// Add get/set methods for your configuration properties here.
	public function getFontColor();

}
