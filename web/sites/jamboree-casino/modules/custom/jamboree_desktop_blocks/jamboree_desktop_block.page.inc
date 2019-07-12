<?php

/**
 * @file
 * Contains jamboree_desktop_block.page.inc.
 *
 * Page callback for Jamboree desktop block entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Jamboree desktop block templates.
 *
 * Default template: jamboree_desktop_block.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_jamboree_desktop_block(array &$variables) {
  // Fetch JamboreeDesktopBlock Entity Object.
  $jamboree_desktop_block = $variables['elements']['#jamboree_desktop_block'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
