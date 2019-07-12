<?php

/**
 * @file
 * Contains zipang_press_entity.page.inc.
 *
 * Page callback for Zipang press entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Zipang press entity templates.
 *
 * Default template: zipang_press_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_zipang_press_entity(array &$variables) {
  // Fetch ZipangPressEntity Entity Object.
  $zipang_press_entity = $variables['elements']['#zipang_press_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
