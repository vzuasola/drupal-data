<?php

/**
 * @file
 * Contains zipang_weekly_winner_entity.page.inc.
 *
 * Page callback for Zipang weekly winner entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Zipang weekly winner entity templates.
 *
 * Default template: zipang_weekly_winner_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_zipang_weekly_winner_entity(array &$variables) {
  // Fetch ZipangWeeklyWinnerEntity Entity Object.
  $zipang_weekly_winner_entity = $variables['elements']['#zipang_weekly_winner_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
