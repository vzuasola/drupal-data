<?php

/**
 * @file
 * Contains sponsor_entity.page.inc.
 *
 * Page callback for Sponsor entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Sponsor templates.
 *
 * Default template: sponsor_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_sponsor_entity(array &$variables) {
  // Fetch SponsorEntity Entity Object.
  $sponsor_entity = $variables['elements']['#sponsor_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
