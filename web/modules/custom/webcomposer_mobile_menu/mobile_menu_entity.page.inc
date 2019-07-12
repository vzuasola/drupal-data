<?php

/**
 * @file
 * Contains mobile_menu_entity.page.inc.
 *
 * Page callback for Mobile menu entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Mobile menu entity templates.
 *
 * Default template: mobile_menu_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_mobile_menu_entity(array &$variables) {
  // Fetch MobileMenuEntity Entity Object.
  $mobile_menu_entity = $variables['elements']['#mobile_menu_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
