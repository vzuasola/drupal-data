<?php

/**
 * @file
 * Contains quick_links_entity.page.inc.
 *
 * Page callback for Quick links entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Quick links entity templates.
 *
 * Default template: quick_links_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_quick_links_entity(array &$variables) {
  // Fetch QuickLinksEntity Entity Object.
  $quick_links_entity = $variables['elements']['#quick_links_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
