<?php

/**
 * @file
 * Contains dropdown_menu_entity.page.inc.
 *
 * Page callback for Dropdown menu entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Dropdown menu entity templates.
 *
 * Default template: dropdown_menu_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_dropdown_menu_entity(array &$variables) {
  // Fetch DropdownMenuEntity Entity Object.
  $dropdown_menu_entity = $variables['elements']['#dropdown_menu_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
