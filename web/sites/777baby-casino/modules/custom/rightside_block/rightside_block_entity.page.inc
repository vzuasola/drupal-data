<?php

/**
 * @file
 * Contains rightside_block_entity.page.inc.
 *
 * Page callback for Rightside block entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Rightside block entity templates.
 *
 * Default template: rightside_block_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_rightside_block_entity(array &$variables) {
  // Fetch RightsideBlockEntity Entity Object.
  $rightside_block_entity = $variables['elements']['#rightside_block_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
