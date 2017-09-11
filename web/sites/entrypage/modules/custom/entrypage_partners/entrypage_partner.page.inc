<?php

/**
 * @file
 * Contains entrypage_partner.page.inc.
 *
 * Page callback for Entrypage partner entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Entrypage partner templates.
 *
 * Default template: entrypage_partner.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_entrypage_partner(array &$variables) {
  // Fetch EntrypagePartner Entity Object.
  $entrypage_partner = $variables['elements']['#entrypage_partner'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
