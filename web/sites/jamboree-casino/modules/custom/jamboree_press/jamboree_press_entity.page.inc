<?php

/**
 * @file
 * Contains jamboree_press_entity.page.inc.
 *
 * Page callback for Jamboree press entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Jamboree press entity templates.
 *
 * Default template: jamboree_press_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_jamboree_press_entity(array &$variables) {
  // Fetch JamboreePressEntity Entity Object.
  $jamboree_press_entity = $variables['elements']['#jamboree_press_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
