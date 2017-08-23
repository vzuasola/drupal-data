<?php

/**
 * @file
 * Contains entrypage_front_block.page.inc.
 *
 * Page callback for Entrypage front block entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Entrypage front block templates.
 *
 * Default template: entrypage_front_block.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_entrypage_front_block(array &$variables) {
  // Fetch EntrypageFrontBlock Entity Object.
  $entrypage_front_block = $variables['elements']['#entrypage_front_block'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
