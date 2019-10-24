<?php

/**
 * @file
 * Contains jackpot_entity.page.inc.
 *
 * Page callback for Jackpot entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Jackpot entity templates.
 *
 * Default template: jackpot_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_jackpot_entity(array &$variables) {
  // Fetch JackpotEntity Entity Object.
  $jackpot_entity = $variables['elements']['#jackpot_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
