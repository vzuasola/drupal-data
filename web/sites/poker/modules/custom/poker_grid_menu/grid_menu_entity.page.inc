<?php

/**
 * @file
 * Contains grid_menu_entity.page.inc.
 *
 * Page callback for Grid menu entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Grid menu entity templates.
 *
 * Default template: grid_menu_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_grid_menu_entity(array &$variables) {
  // Fetch GridMenuEntity Entity Object.
  $grid_menu_entity = $variables['elements']['#grid_menu_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
