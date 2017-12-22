<?php

/**
 * @file
 * Contains game_page_background.page.inc.
 *
 * Page callback for Game Page Background entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Game Page Background templates.
 *
 * Default template: game_page_background.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_game_page_background(array &$variables) {
  // Fetch GamePageBackground Entity Object.
  $game_page_background = $variables['elements']['#game_page_background'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
