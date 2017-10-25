<?php

/**
 * @file
 * Contains registration_theme_entity.page.inc.
 *
 * Page callback for Registration theme entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Registration theme entity templates.
 *
 * Default template: registration_theme_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_registration_theme_entity(array &$variables) {
  // Fetch RegistrationThemeEntity Entity Object.
  $registration_theme_entity = $variables['elements']['#registration_theme_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
