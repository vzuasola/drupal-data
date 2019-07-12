<?php

/**
 * @file
 * Contains zipang_fair_gaming_entity.page.inc.
 *
 * Page callback for Zipang fair gaming entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Zipang fair gaming entity templates.
 *
 * Default template: zipang_fair_gaming_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_zipang_fair_gaming_entity(array &$variables) {
  // Fetch ZipangFairGamingEntity Entity Object.
  $zipang_fair_gaming_entity = $variables['elements']['#zipang_fair_gaming_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
