<?php

/**
 * @file
 * Contains jamboree_rightside_block_entity.page.inc.
 *
 * Page callback for Jamboree rightside block entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Jamboree rightside block entity templates.
 *
 * Default template: jamboree_rightside_block_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_jamboree_rightside_block_entity(array &$variables) {
  // Fetch JamboreeRightsideBlockEntity Entity Object.
  $jamboree_rightside_block_entity = $variables['elements']['#jamboree_rightside_block_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
