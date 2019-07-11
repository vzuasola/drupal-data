<?php

/**
 * @file
 * Contains zipang_jackpot_entity.page.inc.
 *
 * Page callback for Zipang jackpot entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Zipang jackpot entity templates.
 *
 * Default template: zipang_jackpot_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_zipang_jackpot_entity(array &$variables) {
  // Fetch ZipangJackpotEntity Entity Object.
  $zipang_jackpot_entity = $variables['elements']['#zipang_jackpot_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
