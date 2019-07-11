<?php

/**
 * @file
 * Contains jamboree_fair_gaming_entity.page.inc.
 *
 * Page callback for Jamboree fair gaming entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Jamboree fair gaming entity templates.
 *
 * Default template: jamboree_fair_gaming_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_jamboree_fair_gaming_entity(array &$variables) {
  // Fetch JamboreeFairGamingEntity Entity Object.
  $jamboree_fair_gaming_entity = $variables['elements']['#jamboree_fair_gaming_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
