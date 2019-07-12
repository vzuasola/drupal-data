<?php

/**
 * @file
 * Contains metatag_entity.page.inc.
 *
 * Page callback for Metatag entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Metatag entity templates.
 *
 * Default template: metatag_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_metatag_entity(array &$variables) {
  // Fetch MetatagEntity Entity Object.
  $metatag_entity = $variables['elements']['#metatag_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
