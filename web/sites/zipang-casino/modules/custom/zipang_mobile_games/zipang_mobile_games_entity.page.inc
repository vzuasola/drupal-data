<?php

/**
 * @file
 * Contains zipang_mobile_games_entity.page.inc.
 *
 * Page callback for Zipang mobile games entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Zipang mobile games entity templates.
 *
 * Default template: zipang_mobile_games_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_zipang_mobile_games_entity(array &$variables) {
  // Fetch ZipangMobileGamesEntity Entity Object.
  $zipang_mobile_games_entity = $variables['elements']['#zipang_mobile_games_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
