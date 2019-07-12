<?php

/**
 * @file
 * Contains right_side_block_entity.page.inc.
 *
 * Page callback for Inner Page Right Side Block entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Inner Page Right Side Block templates.
 *
 * Default template: right_side_block_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_right_side_block_entity(array &$variables) {
  // Fetch RightSideBlockEntity Entity Object.
  $right_side_block_entity = $variables['elements']['#right_side_block_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
