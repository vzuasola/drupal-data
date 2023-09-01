<?php

/**
 * @file
 * Contains msw_prioritization_menu.page.inc.
 *
 * Page callback for Video Call Prioritization Menu entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Video Call Prioritization Menu templates.
 *
 * Default template: msw_prioritization_menu.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_msw_prioritization_menu(array &$variables) {
  // Fetch MswPrioritizationMenu Entity Object.
  $msw_prioritization_menu = $variables['elements']['#msw_prioritization_menu'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
