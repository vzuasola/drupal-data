<?php

/**
 * @file
 * Contains content_block_entity.page.inc.
 *
 * Page callback for Content block entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Content block entity templates.
 *
 * Default template: content_block_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_content_block_entity(array &$variables) {
  // Fetch ContentBlockEntity Entity Object.
  $content_block_entity = $variables['elements']['#content_block_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
